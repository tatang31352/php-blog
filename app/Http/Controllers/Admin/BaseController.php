<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;

/**
 * 公共控制器
 * 七星瓢虫
 * 2018/10/24
 */
class BaseController extends Controller
{
	/**
	 * 2018/12/23
	 * 初始化
	 * 凡心
	 */
    public function __construct()
    {
    	//防翻墙
    	if(session("admin") == null)
    	{
    		header('location:/admin/login');
    	}
    }
}
