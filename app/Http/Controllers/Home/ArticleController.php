<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\Base;
use App\Http\Models\Home\Article;
use Illuminate\Support\Facades\DB;

class ArticleController extends BaseController
{
	/**
	 * 文章详情
	 * 七星瓢虫
	 * 2018/12/26
	 */
    public function detail(Request $request)
    {
    	if($request->isMethod('get'))
    	{
    		
    		//文章详情
			$article = Article::detail($_GET['id'],$this->user['userid']);
			//热门文章
			$where = [
				'recommend' => 1,
				'user_id'   => $this->user['userid']
			];
			$recommon_article = Article::where($where)
			->select(['article_id','title'])
			->get()->toArray();
	    	return view('home/index/detail',compact('article','recommon_article'));
    	}
    }

    /**
     * 评论
     * 七星瓢虫
     * 2018/12/29
     */
    public function message(Request $request)
    {
    	if($request->isMethod('post'))
    	{
	    	$mes = DB::select('select * from bg_comment where status=? and article_id=? and pid=? order by commentid asc limit ?,?',[1,$_POST['article_id'],0,($_POST['page']-1)*2,2]);
    		$data = $this->get_mess($mes,0,$_POST['article_id']);
    		$pageCount = DB::table('bg_comment')
    		->where('status',1)
    		->where('pid',0)
    		->where('article_id',$_POST['article_id'])
    		->count();
	    	$pageCount = (int)ceil($pageCount/2);
	    	return json_encode(['status'=>200,'data'=>$data,'pageCount'=>$pageCount]);
	    }
    }

    /**
     * 评论
     * 七星瓢虫
     * 2018/12/29
     */
    public function messageAdd(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		//评论
	    	if(empty($_POST['param']))
	    	{
	    		$user = session('blog_user');
    			$data = [
    				'comment'  => $_POST['content'],
    				'pid'      => 0,
    				'user_id'  => $user['id'],
    				'nickname' => $user['nickname'],
    				'ip'       => getIp(), 
    				'os'       => getOs(),
    				'create_time' => date('Y-m-d H:i:s'),
    				'headurl'   => $user['headurl'],
    				'status'   => 1,
    				'reply_nickname' => 0,
    				'reply_id' => 0,
    				'article_id' => $_POST['article_id'],
    				'zan'      => 0
    			];
    			$status = DB::table('bg_comment')->insert($data);
    			return $status ? json_encode(['code'=>1,'msg'=>'留言成功!']) : json_encode(['code'=>2,'msg'=>'留言失败!']);
	    	}else{//回复
	    		$param = explode(',',$_POST['param']);
    			$user = session('blog_user');
    			$data = [
    				'comment'  => $_POST['content'],
    				'pid'      => $param[0],
    				'user_id'  => $user['id'],
    				'nickname' => $user['nickname'],
    				'ip'       => getIp(), 
    				'os'       => getOs(),
    				'create_time' => date('Y-m-d H:i:s'),
    				'headurl'   => $user['headurl'],
    				'status'   => 1,
    				'reply_nickname' => $param[2],
    				'reply_id' => $param[1],
    				'article_id' => $_POST['article_id'],
    				'zan'      => 0
    			];
    			$status = DB::table('bg_comment')->insert($data);
    			return $status ? json_encode(['code'=>1,'msg'=>'回复成功!']) : json_encode(['code'=>2,'msg'=>'回复失败!']);
	    	}
	    }
    }

    /**
     * 点赞
     * 七星瓢虫
     * 2018/12/29
     */
    public function zan(Request $request)
    {
    	if($request->isMethod('post'))
    	{
	    	$user = session('blog_user');
	    	if(DB::select('select id from bg_zan where type = ? and message_id =? and user_id = ?',[2,$_POST['message_id'],$user['id']]))
	    	{
	    		return json_encode(['code'=>2,'msg'=>'您已经点过赞了']);
	    	}

	    	$status = DB::insert('insert into bg_zan (message_id,user_id,type) values(?,?,?)',[$_POST['message_id'],$user['id'],2]);

	    	if($status)
	    	{
	        	DB::table('bg_comment')->where('commentid',$_POST['message_id'])->increment('zan');
	    		return json_encode(['code'=>1,'msg'=>'点赞成功!']);
	    	}else{
	    		return json_encode(['code'=>2,'msg'=>'点赞失败!']);
	    	}
    	}
    }



    /**
     * 递归查留言
	 * @param $data 原始数组
	 * @param $ret
	 * @return mixed
	 */
	private function get_mess($data,$pid,$article){
		$tree = array();
		$datas = DB::select('select * from bg_comment where status=? and article_id=? and pid!=?',[1,$article,0]);
	    foreach($data as $k => $v) {
	     	if($v['pid'] == $pid){
	     		$v['children'] = $this->get_mess($datas,$v['commentid'],$article);
	     		// if(!$v['children']){
	     		// 	unset($v['children']);
	     		// }
	     		$tree[] = $v;
	     	} 
	    }
	    return $tree;
	}

}


