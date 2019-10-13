<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Validates\Admin\PassportValidate;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\DB;


/**
 * 登录模块
 * 2018/10/24
 * 七星瓢虫
 */
class PassportController extends Controller
{
	/**
	 * [login description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function login(Request $request)
    {
    	if (request()->isMethod('post'))
    	{
    		$data  = $request->all();
            $usr = DB::select('select * from bg_user where username = ?',[$data['username']]);
    		if(!$usr)
            {
                return json_encode(['status'=>400,'msg'=>'登录失败,账号不存在!']);
            }
            $usr = $usr[0];
            if($usr['del'] == 1)
            {
                return json_encode(['status'=>400,'msg'=>'登录失败,改账号已被删除!']);
            }
            if($usr['password'] != $data['password'])
            {
                return json_encode(['status'=>400,'msg'=>'登录失败,密码错误!']);
            } 
            session(['admin'=>$usr]);
            return json_encode(['status'=>200,'msg'=>'登录成功!']);
    	}else
    	{
            //最后更新时间
            cache(['last_update_time'=>date('Y-m-d')],99990);
        	return view('admin/manager/login');
    	}
	}


    /**
     * 退出登录
     * 七星瓢虫
     * 2018/12/27
     */
    public function loginOut(Request $request)
    {
        session(['admin'=>null]);
        return redirect('/admin/login');
    }

}
