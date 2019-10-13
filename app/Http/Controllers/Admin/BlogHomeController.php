<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Admin\Bloghome;

/**
 * 博客首页
 * 七星瓢虫
 * 2018/10/24
 */
class BlogHomeController extends BaseController
{
    
    /**
     * 模板列表
     * 七星瓢蟲
     * 2018/12/06
     */
    public function list(Request $request){

        $data = Bloghome::all(['id','home_name','net','motto','btm_motto','occupation','email','hobby','notice']);

        return view('admin/bloghome/list',compact("data"));
    }

    /**
     * 新增模板
     * 七星瓢蟲
     * 2018/12/06
     */
    public function add(Request $request){
        if($request->isMethod('post')){
            
            if(DB::SELECT("SELECT net FROM bg_homepage WHERE home_name=?",[$_POST['home_name']])){
                return  json_encode(['code'=>400,'msg'=>'添加失败,模板名称已存在!']);
            }

            unset($_POST['_token']);
            $_POST['banner']=json_encode($_POST['banner']);
            $status = DB::table('bg_homepage')->insert($_POST);
            return $status ? json_encode(['code'=>200,'msg'=>'添加成功!']) : json_encode(['code'=>400,'msg'=>'添加失败!']);
        }else{
            return view('admin/bloghome/add');
        }
    }

    /**
     * 編輯模板
     * 七星瓢蟲
     * 2018/12/06
     */
    public function upd(Request $request){
        if($request->isMethod('post')){
            if(DB::SELECT("SELECT net FROM bg_homepage WHERE home_name=? AND id != ? ",[$_POST['home_name'],$_POST['id']])){
                return  json_encode(['code'=>400,'msg'=>'编辑失败,模板名称已存在!']);
            }
            unset($_POST['_token']);
            $_POST['banner']=json_encode($_POST['banner']);

            $status = DB::table('bg_homepage')->where('id',$_POST['id'])->update($_POST);
            return $status ? json_encode(['code'=>200,'msg'=>'编辑成功!']) : json_encode(['code'=>400,'msg'=>'编辑失败,与原模板一致!']);
        }else{
            $data = DB::SELECT('SELECT * FROM bg_homepage WHERE id = ?',[$_GET['id']])[0];
            $data['banner'] = json_decode($data['banner']);
            return view('admin/bloghome/upd',compact("data"));
        }
    }

    /**
     * 删除模板
     * 七星瓢虫
     * 2018/12/06
     */
    public function del(Request $request){
        if($request->isMethod('post')){
            if(DB::SELECT('SELECT home_id FROM bg_user WHERE home_id=?',[$_POST['id']])){
                return json_encode(['status'=>400,'msg'=>'刪除失敗,该模板已被管理员使用!']);
            }

            if(DB::DELETE('DELETE FROM bg_homepage WHERE id=?',[$_POST['id']])){

                return json_encode(['status'=>200,'msg'=>'删除模板成功!']);
            }


            return json_encode(['status'=>400,'msg'=>'删除失败,该模板已被管理员使用!']);
        }
    }

}
