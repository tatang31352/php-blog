<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Models\Admin\User;
use Illuminate\Support\Facades\DB;

/**
 * 普通用户
 * 七星瓢虫
 * 2018/10/24
 */
class UserController extends BaseController
{
	/**
	 * 账号列表
	 * 七星瓢虫
	 * 2018/12/31
	 */
    public function list(Request $request){
    	if($request->isMethod('post'))
    	{
    		DB::table('bg_users')->where('id',$_POST['id'])->update(['status'=>$_POST['value']]);
    		return json_encode(['status'=>200,'msg'=>'成功']);

    	}else{
	    	$data = User::orderBy('create_time','asc')
	        ->get();
	        return view('admin/user/list',compact('data'));
    	}
    }

    /**
     * 添加账号
     * 七星瓢虫
     * 2018/12/31
     */
    public function add(Request $request){
    	if($request->isMethod('post'))
    	{
    		if(!empty(DB::table('bg_users')->where('username',$_POST['username'])->get()->toArray()))
    			{
    				return json_encode(['code'=>400,'msg'=>'添加失败,账号已存在!']);
    			}
    		$data = [
    			'username' => $_POST['username'],
    			'nickname' => $_POST['nickname'],
    			'headurl'  => $_POST['logo'],
    			'status'   => 1,
    			'is_qq'    => 0,
    			'create_time' => time(),
    			'ip'       => getIp(),
    			'password' => $_POST['password'],
    			'endtime'  => time(),
    		];	
    		$status = DB::table('bg_users')->insert($data);
    		if($status)
    		{
    			return json_encode(['code'=>200,'msg'=>'新增账号成功!']);

    		}else{
    			return json_encode(['code'=>400,'msg'=>'添加失败,请重试!']);
    		}
    	}else{
        	return view('admin/user/add');
    	}
    }

    /**
     * 编辑账号
     * 七星瓢虫
     * 2018/12/31
     */
    public function upd(Request $request){
    	if($request->isMethod('post')){
    		if(!empty(DB::select('select id from bg_users where username =? and id != ?',[$_POST['username'],$_POST['id']])))
    			{
    				return json_encode(['code'=>400,'msg'=>'添加失败,账号已存在!']);
    			}
    		$data = [
    			'username' => $_POST['username'],
    			'nickname' => $_POST['nickname'],
    			'headurl'  => $_POST['logo'],
    			'ip'       => getIp(),
    			'password' => $_POST['password'],
    			'endtime'  => time(),
    		];	
    		$status = DB::table('bg_users')->where('id',$_POST['id'])->update($data);
    		if($status)
    		{
    			return json_encode(['code'=>200,'msg'=>'编辑账号成功!']);

    		}else{
    			return json_encode(['code'=>400,'msg'=>'编辑失败,请重试!']);
    		}
    	}else{
    		$data = DB::table('bg_users')->find($_GET['id']);
       		return view('admin/user/upd',compact('data'));
    	}
    }

    /**
     * 删除账号
     * 七星瓢虫
     * 2018/12/31
     */
    public function del(Request $request){
    	if($request->isMethod('post'))
    	{
    		DB::table('bg_users')->where('id',$_POST['id'])->delete();
    		return json_encode(['code'=>200,'msg'=>'成功!']);
    	}
    }

}
