<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Home\Article;
use App\Http\Controllers\Home\Base;


class HistoryController extends BaseController
{
	/**
	 * 古今
	 * 七星瓢虫
	 * 2018/12/26
	 */
    public function index(Request $request)
    {
    	
    	if($request->isMethod('post'))
    	{
    		$where['user_id'] = $this->user['userid'];
    		$history = DB::select('select content from bg_history where user_id =?',[$where['user_id']])[0]['content'];
    		$history = json_decode($history,true);
    		//页码
    		$page['pageIndex'] = $_POST['page'];
    		//每页显示的条数
    		$page['pageSize']  = 5;
    		$start = ($page['pageIndex']-1)*$page['pageSize'];
    		if($page['pageIndex']*$page['pageSize'] < count($history)){
    			$end = $page['pageIndex']*$page['pageSize'];
    		}else{
    			$end = count($history);
    		}
    		for($i = $start;$i < $end ;$i++ ){
    			$list[] = $history[$i];
    		}
    		$data["data"] = $list;
    		$data["pageCount"] = (int)ceil(count($history)/$page['pageSize']);
    		return json_encode($data,JSON_UNESCAPED_UNICODE);
    	}else{
    		//热门文章
			$where = [
				'recommend' => 1,
				'user_id'   => $this->user['userid']
			];
			$recommon_article = Article::where($where)
			->select(['article_id','title'])
			->get()->toArray();
	    	return view('home/said/index',compact('recommon_article'));
    	}
    }
}
