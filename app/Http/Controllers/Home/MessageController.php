<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\Base;
use App\Http\Models\Home\Article;
use Illuminate\Support\Facades\DB;

class MessageController extends BaseController
{
	/**
	 * 留言列表
	 * 七星瓢虫
	 * 2018/12/26
	 */
    public function index(Request $request)
    {
    	if($request->isMethod('post')){
    		// $mes = DB::select('select * from bg_message where status=? and admin_id=?',[1,$this->user['userid']]);
    		// $data = $this->get_mess($mes,0);

    		$mes = DB::select('select * from bg_message where status=? and admin_id=? and pid=? order by id asc limit ?,?',[1,$this->user['userid'],0,($_POST['page']-1)*2,2]);
    		$data = $this->get_mess($mes,0);
    		$pageCount = DB::table('bg_message')
    		->where('status',1)
    		->where('pid',0)
    		->where('admin_id',$this->user['userid'])
    		->count();
    		$pageCount = (int)ceil($pageCount/2);
    		return json_encode(['status'=>200,'data'=>$data,'pageCount'=>$pageCount]);
    	}else{
    		//热门文章
			$where = [
				'recommend' => 1,
				'user_id'   => $this->user['userid']
			];
			$recommon_article = Article::where($where)
			->select(['article_id','title'])
			->get()->toArray();
    		return view('home/message/index',compact('recommon_article'));
    	}
    }

    /**
     * 添加留言
     * 七星瓢虫
     * 2018/12/16
     */
    public function add(Request $request)
    {
    	if($request->isMethod('post')){
    		//留言
    		if(empty($_POST['param']))
    		{
    			$user = session('blog_user');
    			$data = [
    				'message'  => $_POST['content'],
    				'user_id'  => $user['id'],
    				'nickname' => $user['nickname'],
    				'ip'       => getIp(), 
    				'os'       => getOs(),
    				'create_time' => date('Y-m-d H:i:s'),
    				'pid'      => 0,
    				'headurl'   => $user['headurl'],
    				'status'   => 1,
    				'reply_nickname' => 0,
    				'reply_id' => 0,
    				'admin_id' => $this->user['userid'],
    				'zan'      => 0
    			];
    			$status = DB::table('bg_message')->insert($data);
    			return $status ? json_encode(['code'=>1,'msg'=>'留言成功!']) : json_encode(['code'=>2,'msg'=>'留言失败!']);
    		}else{//回复
    			$param = explode(',',$_POST['param']);
    			$user = session('blog_user');
    			$data = [
    				'message'  => $_POST['content'],
    				'user_id'  => $user['id'],
    				'nickname' => $user['nickname'],
    				'ip'       => getIp(), 
    				'os'       => getOs(),
    				'create_time' => date('Y-m-d H:i:s'),
    				'pid'      => $param[0],
    				'headurl'   => $user['headurl'],
    				'status'   => 1,
    				'reply_nickname' => $param[2],
    				'reply_id' => $param[1],
    				'admin_id' => $this->user['userid'],
    				'zan'      => 0
    			];
    			$status = DB::table('bg_message')->insert($data);
    			return $status ? json_encode(['code'=>1,'msg'=>'回复成功!']) : json_encode(['code'=>2,'msg'=>'回复失败!']);
    		}
    	}
    }

    /** 
     * 点赞接口
     * 七星瓢虫
     * 2018/12/26
     */
    public function zan(Request $request){
    	if($request->isMethod('post'))
    	{
	    	$user = session('blog_user');
	    	if(DB::select('select id from bg_zan where type = ? and message_id =? and user_id = ?',[1,$_POST['message_id'],$user['id']]))
	    	{
	    		return json_encode(['code'=>2,'msg'=>'您已经点过赞了']);
	    	}

	    	$status = DB::insert('insert into bg_zan (message_id,user_id,type) values(?,?,?)',[$_POST['message_id'],$user['id'],1]);

	    	if($status)
	    	{
	        	DB::table('bg_message')->where('id',$_POST['message_id'])->increment('zan');
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
	// private function get_mess($data,$pid){
	// 	$tree = array();
	//     foreach($data as $k => $v) {
	//      	if($v['pid'] == $pid){
	//      		$v['children'] = $this->get_mess($data,$v['id']);
	//      		// if(!$v['children']){
	//      		// 	unset($v['children']);
	//      		// }
	//      		$tree[] = $v;
	//      	} 
	//     }
	//     return $tree;
	// }

    /**
     * 递归查留言
	 * @param $data 原始数组
	 * @param $ret
	 * @return mixed
	 */
	private function get_mess($data,$pid){
		$tree = array();
		$datas = DB::select('select * from bg_message where status=? and admin_id=? and pid!=?',[1,$this->user['userid'],0]);
	    foreach($data as $k => $v) {
	     	if($v['pid'] == $pid){
	     		$v['children'] = $this->get_mess($datas,$v['id']);
	     		// if(!$v['children']){
	     		// 	unset($v['children']);
	     		// }
	     		$tree[] = $v;
	     	} 
	    }
	    return $tree;
	}

}
