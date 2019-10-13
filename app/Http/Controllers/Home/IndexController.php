<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Home\Base;
use App\Http\Models\Home\Article;


class IndexController extends BaseController
{
	/**
	 * 首页
	 * 七星瓢虫
	 * 2018/12/21
	 */
    public function index(Request $request)
    {
    	if($request->isMethod('get'))
    	{
			//分页
			if(!isset($_GET['page'])){
				$page['pageIndex'] = 1;
			}else{
				$page['pageIndex'] = $_GET['page'];
			}

			$where = ['del'=>0,'lock'=>1,'user_id'=>$this->user['userid']];

			//标签搜索
    		if(isset($_GET['tag'])){
    			$tag = $_GET['tag'];
    			$where['label_id'] = $tag;
    		}else{
    			$tag = 0;
    		}

    		//归档搜索
    		if(isset($_GET['date'])){
    			$date = $_GET['date'];
    			$where['date'] = $date;
    		}else{
    			$date = 0;
    		}

    		//分类搜索
    		if(isset($_GET['typeid'])){
    			$type = $_GET['typeid'];
    			$where['category_id'] = $type;
    		}else{
    			$type = 0;
    		}

			$page['pageSize'] = 6;
			$offset = ($page['pageIndex'] - 1) * $page['pageSize'];
			$article_list = Article::where($where)
			->select(['article_id','title','original','content_title','create_time','author','img'])
            ->offset($offset)->limit($page['pageSize'])
			->get()->toArray();
			$page['pageCount'] =(int)ceil(DB::table('bg_article')
			->where($where)
			->count());
			//热门文章
			$where['recommend'] = 1;
			$recommon_article = Article::where($where)
			->select(['article_id','title'])
			->get()->toArray();
	    	return view('home/index/index',compact('article_list','page','recommon_article','tag','date','type'));
    	}

    }
}
