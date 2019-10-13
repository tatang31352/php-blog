<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;


class IndexController extends BaseController
{
    /**
     * 登录首页
     * 七星瓢虫
     * 2018/10/24
     */
    public function index()
    {
        $admin = session('admin');
        return view('admin/index/index',compact('admin'));
    }


    /**
     * 控制台
     * 七星瓢虫
     * 2018/10/24
     */
    public function main()
    {
        return view('admin/index/main');
    }
}
