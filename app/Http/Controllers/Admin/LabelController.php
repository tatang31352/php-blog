<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Admin\Label;

/**
 * 关于标签
 * 七星瓢虫
 * 2018/10/24
 */
class LabelController extends BaseController
{
	/**
	 * 便签列表
	 * 七星瓢虫
	 * 2018/12/12
	 */
    public function list(Request $request){
		$data = Label::all();
    	return view('admin/label/list',compact('data'));
    }

    /**
     * 新增标签
     * 七星瓢虫
     * 2018/12/12
     */
    public function add(Request $request){
    	if($request->isMethod('post')){
	        if(DB::SELECT("SELECT label_name FROM bg_label WHERE label_name=?",[$_POST['label_name']])){
	        	return json_encode(['status'=>400,'msg'=>'添加失败,模板名称已存在!']);
	        }

	        $data = [
	        	'label_name'  => $_POST['label_name'],
	        	'color'       => $_POST['color'],
	        	'create_time' => date('Y-m-d H:i:s'),
	        ];

	        $status = DB::table('bg_label')->insert($data);

	        return $status ? json_encode(['status'=>200,'msg'=>'添加成功!']) : json_encode(['status'=>500,'msg'=>'添加失败,未知错误,联系管理员!']);

    	}else{
        	return view('admin/label/add');
    	}
    }

    /**
     * 编辑标签
     * 七星瓢虫
     * 2018/12/12
     */
    public function upd(Request $request){
    	if($request->isMethod('post')){
    		if(DB::SELECT("SELECT label_name FROM bg_label WHERE label_name=? AND label_id != ?",[$_POST['label_name'],$_POST['id']])){
	        	return json_encode(['status'=>400,'msg'=>'编辑失败,模板名称已存在!']);
    		}

    		$data = [
    			'label_name' => $_POST['label_name'],
    			'color'  => $_POST['color'],
    			'create_time' => date('Y-m-d H:i:s')
    		];

    		$status = DB::table('bg_label')->where('label_id',$_POST['id'])->update($data);
    		return $status ? json_encode(['status'=>200,'msg'=>'修改成功!']) : json_encode(['status'=>500,'msg'=>'修改失败,未知错误,联系管理员!']);
    	}else{
    		$data = DB::SELECT("SELECT * FROM bg_label WHERE Label_id=?",[$_GET['id']])[0];
        	return view('admin/label/upd',compact("data"));
    	}
    }

    /**
     * 删除标签
     * 七星瓢虫
     * 2018/12/12
     */
    public function del(Request $request){
    	 if($request->isMethod('post')){
            if(DB::SELECT("SELECT label_id FROM bg_article WHERE label_id=?",[$_POST['id']])){
                return json_encode(['status'=>400,'msg'=>'删除失败,该模板已被文章使用!']);
            }

            $status = DB::delete("delete from bg_label where label_id=?",[$_POST['id']]);

            return $status ? json_encode(['status'=>200,'msg'=>'删除成功!']) : json_encode(['status'=>500,'msg'=>'删除失败,未知错误,请联系管理员!']);
        }
    }

}
