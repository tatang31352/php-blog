<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\Base;
use Illuminate\Support\Facades\DB;

class AboutController extends BaseController
{
    public function index(Request $request)
    {
    	$blog = DB::select("select * from bg_about_blog where id = ?",[$this->user['blog_id']])[0];
    	$author = DB::select("select * from bg_about_author where id = ?",[$this->user['blog_id']])[0];

    	return view('home/index/about',compact('blog','author'));
    }
}
