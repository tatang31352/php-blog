<?php
namespace App\Http\Controllers\Common;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller{

    /**
     * 图片上传
     * 七星瓢虫
     * 2018/11/29
     */
    public function image(Request $request){
        //上传logo图
        if(isset($request->file()['logo'])){
            $img = $request->file('logo');
            $time = time();
            $info = $img->move('../public/static/upload/logo',$time.'.png');
            if($info){
                $url = '/static/upload/logo/'.$time.'.png';
                return json_encode(['status'=>200,'msg'=>'成功!','url'=>$url]);
            }else{
                return json_encode(['status'=>500,'msg'=>'图片非法!']);
            }
        }

        //上传轮播图
        if(isset($request->file()['banner'])){
            $img = $request->file('banner');
            $time = time();
            $info = $img->move('../public/static/upload/banner',$time.'.png');
            if($info){
                $url = '/static/upload/banner/'.$time.'.png';
                return json_encode(['status'=>200,'msg'=>'成功!','url'=>$url]);
            }else{
                return json_encode(['status'=>500,'msg'=>'图片非法!']);
            }
        }
        
    }


    
}




?>