<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Models\Admin\Admin;
use Illuminate\Support\Facades\DB;
/**
 * 后台管理员模块
 * 七星瓢虫
 * 2018/10/24
 */
class AdminController extends BaseController
{
   
    /**
     * 管理员列表
     * 七星瓢虫
     * 2018/11/27
     * 
     */
    public function list(Request $request){

        $data = Admin::where('del',0)
        ->orderBy('create_time','asc')
        ->get();

        return view('admin/admin/list',compact("data"));
    }

    /**
     * 新增管理员
     * 七星瓢虫
     * 2018/11/27
     */
    public function add(Request $request){
        
        if($request->isMethod('post')){

            if(Admin::where('username',$_POST['username'])->first()){
                return json_encode(['status'=>300,'msg'=>'新增管理员失败,该账号昵称已存在!']);
            }else{

                //去除laravel自带的验证信息
                unset($_POST['_token']);
                $_POST['create_time'] = date('Y-m-d H:i:s');
                $model =Admin::create($_POST);
                return json_encode(['status'=>200,'msg'=>'新增管理员成功!']);
            }
        }else{
            $homePage = DB::SELECT("SELECT id,home_name FROM bg_homepage"); 
            $author   = DB::SELECT("SELECT id,name FROM bg_about_author");
            $blog   = DB::SELECT("SELECT id,title FROM bg_about_blog");
            return view('admin/admin/add',compact('homePage','author','blog'));
        }
    }

    /**
     * 修改管理员
     * 七星瓢虫
     * 2018/11/27
     */
    public function upd(Request $request){
        if($request->isMethod('post')){
            $isName = DB::SELECT('SELECT username,userid FROM bg_user where username=? and userid !=?',[$_POST['username'],$_POST['userid']]);
            if($isName){
                return json_encode(['status'=>400,'msg'=>'修改失败,改账户昵称已存在!']);
            }
            unset($_POST['_token']);
            if(DB::update('update bg_user set username=?,password=?,home_id=?,blog_id=?,author_id=?,sex=?,programmer=?,Remarks=? where userid=?',array_values($_POST))){
                return json_encode(['status'=>200,'修改成功']);
            }else{
                return json_encode(['status'=>400,'修改失败,您尚未做任何修改!']);
            }
        }else{

            $homePage = DB::SELECT("SELECT id,home_name FROM bg_homepage"); 
            $author   = DB::SELECT("SELECT id,name FROM bg_about_author");
            $blog   = DB::SELECT("SELECT id,title FROM bg_about_blog");
            $data = DB::SELECT('SELECT * FROM bg_user where userid =?',[$_GET['id']])[0];
            return view('admin/admin/upd',compact("data",'homePage','author','blog'));
        }
    }

    /**
     * 修改管理员状态,性别,程序猿,删除
     * 七星瓢虫
     * 2018/11/27
     */
    public function del(Request $request){
        if($request->isMethod('post')){
            $user = Admin::find($_POST['id']);
            $field = $_POST['field']; 
            $user->$field= $_POST['value'];
            $user->save();
            return json_encode(['code'=>200,'msg'=>'成功!']);
        }
    }

    /**
     * 是否开启
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function open(Request $request){
        if($request->isMethod('post')){
            DB::table('bg_user')->update(['open'=>0]);
            $status = DB::table('bg_user')->where('userid',$_POST['id'])->update(['open'=>1]);
            if($status)
            {
                return json_encode(['status'=>200,'msg'=>'开启成功!']);
            }else{
                return json_encode(['status'=>400,'msg'=>'开启失败,请重试!']); 
            }
        }
    }


}
