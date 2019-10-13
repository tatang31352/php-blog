<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;


/**
 * 模型页面(上线可删除)
 * 七星瓢虫
 * 2018/10/24
 */
class TestController extends Controller
{
    public function from(Request $request)
    {
        return view('admin/test/form');
    }

    public function page(Request $request)
    {
        return view('admin/test/page');
    }
    
    public function login(Request $request)
    {
        return view('admin/test/login');
    }

    public function users(Request $request)
    {
        return view('admin/test/users');
    }

    public function roles(Request $request)
    {
        return view('admin/test/roles');
    }
}
