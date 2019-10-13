<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Admin\Category;

/**
 * 文章分类
 * 七星瓢虫
 * 2018/10/24
 */
class CategoryController extends BaseController
{
	/**
	 * 文章分类列表
	 * 七星瓢虫
	 * 2018/12/12
	 */
    public function list(Request $request){
    	$data = Category::all();
        return view('admin/category/list',compact("data"));
    }

    /**
     * 新增文章分类
     * 七星瓢虫
     * 2018/12/12
     */
    public function add(Request $request){
    	if($request->isMethod('post')){
    		if(DB::SELECT("SELECT category FROM bg_category WHERE category=?",[$_POST['category']])){
    			return json_encode(['status'=>400,'msg'=>'添加失败,模板名称已存在!']);
    		}
    		$data = [
    			'category' => $_POST['category'],
    			'life'     => $_POST['file'],
    			'create_time' => date('Y-m-d H:i:s'),
    		];

    		$status= DB::table('bg_category')->insert($data);

    		if($status){
    			return json_encode(['status'=>200,'msg'=>'恭喜您,添加分类成功!']);
    		}

    		return json_encode(['status'=>500,'msg'=>'添加失败,未知错误,联系管理员!']);

    	}else{
        	return view('admin/category/add');
    	}
    }

    /**
     * 编辑文章分类
     * 七星瓢虫
     * 2018/12/12
     */
    public function upd(Request $request){
        if($request->isMethod('post'))
        {

            if( DB::SELECT("SELECT category FROM bg_category WHERE category=? AND category_id != ?",[$_POST['category'],$_POST['id']]))
            {
                return json_encode(['status'=>400,'msg'=>'提交失败,该模板名称已存在']);
            }
            $data = [
                'life'  => $_POST['life'],
                'category' => $_POST['category'],
                'create_time' => date('Y-m-d H:i:s'),
            ];
            if(DB::table('bg_category')->where('category_id',$_POST['id'])->update($data)){
                
                return json_encode(['status'=>200,'msg'=>'编辑模板成功!']);
            }
            return json_encode(['status'=>500,'msg'=>'编辑失败,与原模板一致!']);
        }else{
            $data = DB::SELECT("SELECT * FROM bg_category WHERE category_id=?",[$_GET['id']])[0];
            return view('admin/category/upd',compact('data'));
        }
    }

    /**
     * 删除文章分类
     * 七星瓢虫
     * 2018/12/12
     */
    public function del(Request $request){
        if($request->isMethod('post')){
            if(DB::SELECT("SELECT category_id FROM bg_article WHERE category_id=?",[$_POST['id']])){
                return json_encode(['status'=>400,'msg'=>'删除失败,该模板已被文章使用!']);
            }

            $status = DB::delete("delete from bg_category where category_id=?",[$_POST['id']]);

            return $status ? json_encode(['status'=>200,'msg'=>'删除成功!']) : json_encode(['status'=>500,'msg'=>'删除失败,未知错误,请联系管理员!']);
        }
    }

}
