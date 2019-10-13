<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//默认登录页面
Route::get('/','Home\IndexController@index');


//######################后台页面##############################
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

	//登录
	Route::any('login','PassportController@login');
	Route::any('loginOut','PassportController@loginOut');
	
	//首页
	Route::any('index/index','IndexController@index');
	Route::any('index/main','IndexController@main');

	//管理员
	Route::any('admin/add','AdminController@add');
	Route::any('admin/upd','AdminController@upd');
	Route::any('admin/list','AdminController@list');
	Route::any('admin/del','AdminController@del');
	Route::any('admin/open','AdminController@open');

	//普通用户
	Route::any('user/add','UserController@add');
	Route::any('user/upd','UserController@upd');
	Route::any('user/list','UserController@list');
	Route::any('user/del','UserController@del');

	//相册
	Route::any('album/add','AlbumController@add');
	Route::any('album/upd','AlbumController@upd');
	Route::any('album/list','AlbumController@list');
	Route::any('album/del','AlbumController@del');

	//文章
	Route::any('article/add','ArticleController@add');
	Route::any('article/upd','ArticleController@upd');
	Route::any('article/list','ArticleController@list');
	Route::any('article/del','ArticleController@del');


	//博客首页
	Route::any('bloghome/add','BlogHomeController@add');
	Route::any('bloghome/upd','BlogHomeController@upd');
	Route::any('bloghome/list','BlogHomeController@list');
	Route::any('bloghome/del','BlogHomeController@del');

	//关于作者
	Route::any('author/add','AuthorAboutController@add');
	Route::any('author/upd','AuthorAboutController@upd');
	Route::any('author/list','AuthorAboutController@list');
	Route::any('author/del','AuthorAboutController@del');

	//关于博客
	Route::any('blog/add','BlogAboutController@add');
	Route::any('blog/upd','BlogAboutController@upd');
	Route::any('blog/list','BlogAboutController@list');
	Route::any('blog/del','BlogAboutController@del');

	//分类
	Route::any('cat/add','CategoryController@add');
	Route::any('cat/upd','CategoryController@upd');
	Route::any('cat/list','CategoryController@list');
	Route::any('cat/del','CategoryController@del');

	//评论
	Route::any('comment/add','CommentController@add');
	Route::any('comment/upd','CommentController@upd');
	Route::any('comment/list','CommentController@list');
	Route::any('comment/del','CommentController@del');

	//古今
	Route::any('history/add','HistoryController@add');
	Route::any('history/upd','HistoryController@upd');
	Route::any('history/list','HistoryController@list');
	Route::any('history/del','HistoryController@del');

	//标签
	Route::any('label/add','LabelController@add');
	Route::any('label/upd','LabelController@upd');
	Route::any('label/list','LabelController@list');
	Route::any('label/del','LabelController@del');

});

//######################前台页面##############################
Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
	//首页
	Route::any('index','IndexController@index');
	//文章
	Route::any('article','ArticleController@detail');
	//文章评论列表
	Route::any('article/message','ArticleController@message');
	//文章评论添加
	Route::any('article/messageAdd','ArticleController@messageAdd');
	//文章评论点赞
	Route::any('article/zan','ArticleController@zan');
	//古今
	Route::any('history','HistoryController@index');
	//留言
	Route::any('message','MessageController@index');
	//添加留言
	Route::any('message/add','MessageController@add');
	//点赞
	Route::any('message/zan','MessageController@zan');
	//关于
	Route::any('about','AboutController@index');
	//登录
	Route::any('login','LoginController@index');
	//注册
	Route::any('register','LoginController@resiter');
	//发送短信
	Route::any('sms','LoginController@sms');
	//退出登录
	Route::any('loginOut','LoginController@loginOut');
});



//公共模块
Route::group(['prefix'=>'common','namespace'=>'Common'],function(){
	//图片上传接口
	Route::any('common/upload','UploadController@image');
});














//模板页
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	Route::any('test/from','TestController@from');
	Route::any('test/login','TestController@login');
	Route::any('test/users','TestController@users');
	Route::any('test/roles','TestController@roles');

});

