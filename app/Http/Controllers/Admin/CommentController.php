<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;

/**
 * 关于评论
 * 七星瓢虫
 * 2018/10/24
 */
class CommentController extends BaseController
{
    public function list(Request $request){
        return view('admin/comment/list');
    }

    public function add(Request $request){

    }

    public function upd(Request $request){

    }

    public function del(Request $request){

    }

}
