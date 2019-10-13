<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;

/**
 * 相册模块
 * 七星瓢虫
 * 2018/10/24
 */
class AlbumController extends BaseController
{
    public function add(Request $request){

        return view('admin/admin/add');

    }

    public function upd(Request $request){

        return view('admin/admin/upd');

    }

    public function del(Request $request){
    }

    public function list(Request $request){
        
        return view('admin/album/list');
    }
    
}
