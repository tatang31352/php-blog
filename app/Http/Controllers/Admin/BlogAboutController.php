<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Admin\Blog;

/**
 * 关于博客
 * 七星瓢虫
 * 2018/10/24
 */
class BlogAboutController extends BaseController
{

    /**
     * 博客列表
     * 七星瓢虫
     * 2018/12/11
     */
    public function list(Request $request){
        $data = Blog::all(['id','title','blog_name']);
        return view('admin/blog/list',compact("data"));
    }

    /**
     * 增加博客模板
     * 七星瓢虫
     * 2018/12/11
     */
    public function add(Request $request){
        if($request->isMethod('post')){
            if( DB::SELECT("SELECT blog_name FROM bg_about_blog WHERE blog_name=?",[$_POST['blog_name']])){
                return json_encode(['status'=>400,'msg'=>'提交失败,该模板名称已存在']);
            }

            if(DB::INSERT("INSERT INTO bg_about_blog (title,blog_name,content) values(?,?,?)",[$_POST['title'],$_POST['blog_name'],$_POST['content']])){
                
                return json_encode(['status'=>200,'msg'=>'添加模板成功!']);
            }
            return json_encode(['status'=>500,'msg'=>'未知错误,联系管理员!']);
        }else{
            return view('admin/blog/add');
        }
    }

    /**
     * 编辑博客模板
     * 七星瓢虫
     * 2018/12/11
     */
    public function upd(Request $request){
        if($request->isMethod('post')){
            if(DB::SELECT("SELECT id FROM bg_about_blog WHERE blog_name=? AND id != ? ",[$_POST['blog_name'],$_POST['id']])){
                
                return json_encode(['status'=>400,'msg'=>'提交失败,该模板名称已存在']);
            }

            unset($_POST['_token']);
            $status = DB::table('bg_about_blog')->where('id',$_POST['id'])->update($_POST);
            return $status ? json_encode(['status'=>200,'msg'=>'编辑成功!']) : json_encode(['status'=>400,'msg'=>'编辑失败,与原模板一致!']);

        }else{
            $data = Db::SELECT("SELECT * FROM bg_about_blog WHERE id=?",[$_GET['id']])[0];
            return view('admin/blog/upd',compact("data"));
        }
    }


    /**
     * 删除模板
     * 七星瓢虫
     * 2018/12/11
     */
    public function del(Request $request){
        if($request->isMethod('post')){
            if(DB::SELECT('SELECT blog_id FROM bg_user WHERE blog_id=?',[$_POST['id']])){
                return json_encode(['status'=>400,'msg'=>'刪除失敗,该模板已被管理员使用!']);
            }

            if(DB::DELETE('DELETE FROM bg_about_blog WHERE id=?',[$_POST['id']])){

                return json_encode(['status'=>200,'msg'=>'删除模板成功!']);
            }


            return json_encode(['status'=>400,'msg'=>'删除失败,未知错误!']);
        }
    }

}
