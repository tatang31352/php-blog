<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Admin\Author;


/**
 * 关于作者
 * 七星瓢虫
 * 2018/10/24
 */
class AuthorAboutController extends BaseController
{
    /**
     * 作者模板列表
     * 七星瓢虫
     * 2018/12/11
     */
    public function list(Request $request){
        $data = Author::all(['id','img','name','introduce','address','phone','email','gitee','author_name']);
        return view('admin/author/list',compact("data"));
    }

    /**
     * 新增作者模板
     * 七星瓢虫
     * 2018/12/11
     */
    public function add(Request $request){
        if($request->isMethod('post')){
            if( DB::SELECT("SELECT author_name FROM bg_about_author WHERE author_name=?",[$_POST['author_name']])){
                return json_encode(['status'=>400,'msg'=>'提交失败,该模板名称已存在']);
            }

            unset($_POST['_token']);
            if(DB::table('bg_about_author')->insert($_POST)){
                
                return json_encode(['status'=>200,'msg'=>'添加模板成功!']);
            }
            return json_encode(['status'=>500,'msg'=>'未知错误,联系管理员!']);
        }else{
            return view('admin/author/add');
        }
    }

    /**
     * 编辑作者模板
     * 七星瓢虫
     * 2018/12/11
     */
    public function upd(Request $request){
        if($request->isMethod('post')){
            if( DB::SELECT("SELECT author_name FROM bg_about_author WHERE author_name=? AND id != ?",[$_POST['author_name'],$_POST['id']])){
                return json_encode(['status'=>400,'msg'=>'提交失败,该模板名称已存在']);
            }
            unset($_POST['_token']);
            if(DB::table('bg_about_author')->where('id',$_POST['id'])->update($_POST)){
                
                return json_encode(['status'=>200,'msg'=>'编辑模板成功!']);
            }
            return json_encode(['status'=>500,'msg'=>'编辑失败,与原模板一致!']);
        }else{
            $data = DB::SELECT("SELECT * FROM bg_about_author WHERE id=?",[$_GET['id']])[0];
            return view('admin/author/upd',compact('data'));
        }

    }

    /**
     * 删除模板
     * 七星瓢虫
     * 2018/12/11
     */
    public function del(Request $request){

        if($request->isMethod('post')){
            if(DB::SELECT('SELECT author_id FROM bg_user WHERE author_id=?',[$_POST['id']])){
                return json_encode(['status'=>400,'msg'=>'刪除失敗,该模板已被管理员使用!']);
            }

            if(DB::DELETE('DELETE FROM bg_about_author WHERE id=?',[$_POST['id']])){

                return json_encode(['status'=>200,'msg'=>'删除模板成功!']);
            }

            return json_encode(['status'=>400,'msg'=>'删除失败,未知错误!']);
        }

    }

}
