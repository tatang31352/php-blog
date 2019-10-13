<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;


class BaseController extends Controller
{
	/**
	 * 2018/12/23
	 * 初始化
	 * 凡心
	 */
	public function __construct()
	{
		$this->user = Db::select("SELECT * FROM bg_user WHERE open = 1 AND del = 0")['0'];
		//获得文章标签
        $article_tag_list = $this->getArticleTags();
        //用户信息
		$user = $this->base();
		//文章归档
		$article_archiving = $this->articleArchiving();
		//首页模板
    	$home = $this->homePage();
    	//网站统计
    	$web_count = $this->webCount();
    	//分类
    	$category = $this->baseCategory();
		View::share([
			'article_tag_list'=>$article_tag_list,
			'user'=>$user,
			'article_archiving'=>$article_archiving,
			'banner' => json_decode($home['banner']),
			'notice' => explode(',',$home['notice']),
			'friendship_link'=>explode(',',$home['friendship_link']),
			'link_address'=>explode(',',$home['link_address']),
			'web_count' => $web_count,
			'home'   =>  $home,
			'category'  => $category,
		]);
	}

	/**
	 * 分类
	 * 七星瓢虫
	 * 2018/12/25
	 */
	public function baseCategory()
	{
		$data['programmer'] = $this->user['programmer'];
		$data['life'] = DB::select('SELECT * FROM bg_category WHERE life = 1');
		$data['noLife'] = DB::select('SELECT * FROM bg_category WHERE life = 0');
		return $data;
	}

	/**
	 * 博客首页
	 * 七星瓢虫
	 * 2018/12/24
	 */
	public function homePage()
	{
		$home = Db::select("SELECT * FROM bg_homepage WHERE id = ?",[$this->user['home_id']])[0];
		return $home;
	}

	/**
	 * 网站统计
	 * 七星瓢虫
	 * 2018/12/24
	 */
	public function webCount()
	{
		$data['create_date'] = '2018-12-24';
		$data['article_count'] = DB::SELECT("SELECT count('article_id') as count FROM bg_article WHERE user_id=?",[$this->user['userid']])[0]['count'];
		$data['diff_date'] = (int)floor((time() - strtotime($data['create_date'])) / (60*60*24));
		$data['last_update_time'] = cache('last_update_time');
		$data['label_count'] = DB::SELECT("SELECT count('label_id') as count FROM bg_label")[0]['count'];
		return $data;
	}

	/**
	 * 获得所有文章标签
	 * 七星瓢虫
	 * 2018/12/23
	 */
	public function getArticleTags()
	{
		$list = DB::select("select * from bg_label");
		return $list;
	}

	/**
	 * 获取文章归档
	 * 七星瓢虫
	 * 2018/12/23
	 */
	public function articleArchiving()
	{
	
		$list = DB::SELECT('select date as date_show,date  FROM bg_article where del = 0 group by date order By date desc');
		return $list;
	}


	/**
	 * 授权登录信息是否获取 用户非法操作
	 */
	public function base()
	{
		$user = session('blog_user');
		return $user;
	}
}