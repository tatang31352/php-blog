<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Admin\Article;

/**
 * 文章列表
 * 七星瓢虫
 * 2018/10/24
 */
class ArticleController extends BaseController
{

	/**
	 * 文章列表
	 * 七星瓢虫
	 * 2018/12/13
	 */
    public function list(Request $request){
        $data = Article::where('del',0)
        ->orderBy('create_time','asc')
        ->get();
        return view('admin/article/list',compact("data"));
    }

    /**
     * 新增文章
     * 七星瓢虫
     * 2018/12/13
     */
    public function add(Request $request){
    	if($request->isMethod('post')){
            if(Db::SELECT("SELECT title FROM bg_article WHERE title=?",[$_POST['title']])){
                return json_encode(['status'=>400,'msg'=>'添加失败,改文章标题已存在!']);
            }

            unset($_POST['_token']);
            $_POST['del'] = 0;
            $_POST['lock'] = 0;
            $_POST['create_time'] = time();
            $_POST['date'] = date('Y-m',time());
            $status = DB::table('bg_article')->insert($_POST);
            return $status ? json_encode(['status'=>200,'msg'=>'添加文章成功!']) : json_encode(['status'=>500,'msg'=>'添加文章失败,未知错误,请联系管理员!']);
    	}else{
    		$author   = DB::SELECT("SELECT name FROM bg_about_author");
    		$category = DB::SELECT("SELECT category_id,category FROM bg_category");
    		$label = DB::SELECT("SELECT label_id,label_name FROM bg_label");
    		$user = DB::SELECT("SELECT userid,username FROM bg_user");
        	return view('admin/article/add',compact('author','category','label','user'));
    	}
    }

    /**
     * 文章修改
     * 七星瓢虫
     * 2018/12/13
     */
    public function upd(Request $request){
        if($request->isMethod('post')){
            if(Db::SELECT("SELECT title FROM bg_article WHERE title=? AND article_id != ?",[$_POST['title'],$_POST['article_id']])){
                return json_encode(['status'=>400,'msg'=>'添加失败,改文章标题已存在!']);
            }

            unset($_POST['_token']);
            // $_POST['create_time'] = time(); 
            // $_POST['date'] = date('Y-m',time());  
            $status = DB::table('bg_article')->where('article_id',$_POST['article_id'])->update($_POST);
            return $status ? json_encode(['status'=>200,'msg'=>'添加文章成功!']) : json_encode(['status'=>500,'msg'=>'添加文章失败,未知错误,请联系管理员!']);
        }else{
            $author   = DB::SELECT("SELECT name FROM bg_about_author");
            $category = DB::SELECT("SELECT category_id,category FROM bg_category");
            $label = DB::SELECT("SELECT label_id,label_name FROM bg_label");
            $user = DB::SELECT("SELECT userid,username FROM bg_user");
            $data = DB::SELECT("SELECT * FROM bg_article WHERE article_id=?",[$_GET['id']])[0];
            return view('admin/article/upd',compact('author','category','label','user','data'));
        }
    }

    /**
     * 删除文章
     * 七星瓢虫
     * 2018/12/13
     */
    public function del(Request $request){
         if($request->isMethod('post')){
            $user = Article::find($_POST['id']);
            $field = $_POST['field']; 
            $user->$field= $_POST['value'];
            $user->save();
        }
    }

}
