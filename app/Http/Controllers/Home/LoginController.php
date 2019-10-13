<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\Base;
use App\Http\Controllers\Common\Sms;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\DB;
use Validator;

class LoginController extends BaseController
{
	/**
	 * 登录
	 * 七星瓢虫
	 * 2018/12/26
	 */
    public function index(Request $request)
    {
    	if($request->isMethod('post')){
    		// 验证验证码
    		$rules = ['code' => 'required|captcha'];
			$validator = Validator::make($_POST, $rules);
    		if($validator->fails()){
				return json_encode(['status'=>400,'msg'=>'图片验证码错误']);
			}

			//验证是否注册
			$res = DB::table('bg_users')->where('username',$_POST['phone'])->get()->toArray();
			if(empty($res))
			{
				return json_encode(['status'=>400,'msg'=>'登录失败,账号不存在!']);
			}
			
			if($res[0]['password'] != $_POST['password'])
			{
				return json_encode(['status'=>400,'msg'=>'登录失败,密码错误!']);
			}

			session(['blog_user'=>$res[0]]);
			$data = [
				'endtime' => time(),
				'ip'      => getIp(), 
			];
			DB::table('bg_users')->where('username',$_POST['phone'])->update($data);
			return json_encode(['status'=>200,'msg'=>'登录成功,正在跳转!']);
    	}else{

    		return view('home/user/login');
    	}

    }

    /**
     * 注册
     * 七星瓢虫
     * 2018/12/26
     */
    public function resiter(Request $request)
    {
    	if($request->isMethod('post')){
    		$rules = ['code' => 'required|captcha'];
			$validator = Validator::make($_POST, $rules);
			if($validator->fails()){
				return json_encode(['status'=>400,'msg'=>'图片验证码错误']);
			}
			if(Cache::get($_POST['phone']) != $_POST['phone_code']){
				return json_encode(['status'=>400,'msg'=>'短信验证码错误']);
			}
			//验证是否注册
			if(!empty(DB::table('bg_users')->where('username',$_POST['phone'])->get()->toArray()))
			{
				return json_encode(['status'=>400,'msg'=>'注册失败,该手机号已被注册']);
			}

			$data = [
				'username' => $_POST['phone'],
				'nickname' => $_POST['nickname'],
				'is_qq'    => 0,
				'ip' => getIp(),
				'create_time'=>time(),
				'endtime'   => time(),
				'qq_openid' => 0,
				'status'   => 1,
				'password' => $_POST['password'],
				'headurl'  => '/static/common/images/face/'.rand(1,13).'.jpg',
			];
			$status = DB::table('bg_users')->insert($data);
			if($status){
				return json_encode(['status'=>200,'msg'=>'注册成功']);
			}else{
				return json_encode(['status'=>400,'msg'=>'注册失败,联系管理员']);
			}
    	}else{

    		return view('home/user/reg');
    	}
    }

    /**
     * 发送短信验证码
     * 七星瓢虫
     * 2018/12/27
     */
    public function sms(Request $request)
    {
    	if($request->isMethod('post')){
    		$phone = $_POST['phone'];
    		$code = rand(1000,9999);
    		try{
    			$response = Sms::sendSms($phone,$code);
    		}catch (\Exception $e) {
    			Log::info('发送短信验证码错误,错误位置:App\Http\Controllers\HomeLoginController\sms');
    		}

    		if($response->Code === "OK"){
    			Cache::put($phone,$code,5);
    			return json_encode(['status'=>200,'msg'=>'发送短信成功!']);
    		}else{
    			return json_encode(['status'=>400,'msg'=>'发送失败,阿里内部服务器错误']);
    		}

    	}
    }

    /**
     * 退出登录
     * 七星瓢虫
     * 2018/12/27
     */
    public function loginOut(Request $request)
    {
    	session(['blog_user'=>null]);
    	return redirect('/');
    }

}
