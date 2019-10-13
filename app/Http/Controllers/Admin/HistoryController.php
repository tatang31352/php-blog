<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Admin\History;

/**
 * 我的古今
 * 七星瓢虫
 * 2018/10/24
 */
class HistoryController extends BaseController
{
	/**
	 * 古今列表
	 * 七星瓢虫
	 * 2018/12/16
	 */
    public function list(Request $request){
    	if($request->isMethod('post')){

    	}else{
            $data = History::all();
            return view('admin/history/list',compact('data'));
        }
    }

    /**
     * 新增古今
     * 七星瓢虫
     * 2018/12/16
     */
    public function add(Request $request){
        if($request->isMethod('post')){
           if(Db::SELECT("SELECT user_id FROM bg_history WHERE user_id=?",[$_POST['user']]) && $_POST['user'] != 0){
            return json_encode(['status'=>400,'msg'=>'添加失败,关联账号已被关联!']);
           }
           $data = [
            'create_time' => time(),
            'user_id'     => $_POST['user'],
            'content'     => json_encode($_POST['content'])
           ];

           $status = DB::table("bg_history")->insert($data);
           return $status ? json_encode(['status'=>200,'msg'=>'添加成功!']) : json_encode(['status'=>400,'msg'=>'添加失败,未知错误,联系管理员!']);


        }else{
            $user = DB::SELECT("SELECT userid,username FROM bg_user");
            return view('admin/history/add',compact('user'));
        }
    }

    /**
     * 修改古今
     * 七星瓢虫
     * 2018/12/16
     */
    public function upd(Request $request){
        if($request->isMethod('post')){
            if(Db::SELECT("SELECT user_id FROM bg_history WHERE user_id=? AND historyid != ?",[$_POST['user'],$_POST['historyid']]) && $_POST['user'] != 0){
            return json_encode(['status'=>400,'msg'=>'修改失败,关联账号已被关联!']);
           }

           $data = [
            'create_time' => time(),
            'user_id'     => $_POST['user'],
            'content'     => json_encode($_POST['content'])
           ];

           $status = DB::table("bg_history")->where('historyid',$_POST['historyid'])->update($data);
           return $status ? json_encode(['status'=>200,'msg'=>'修改成功!']) : json_encode(['status'=>400,'msg'=>'修改失败,未做任何修改!']);
        }else{
            $data = Db::SELECT("SELECT * FROM bg_history WHERE historyid=?",[$_GET['id']])[0];
            $data['content'] = json_decode($data['content']);
            $user = DB::SELECT("SELECT userid,username FROM bg_user");
        	return view('admin/history/upd',compact('data','user'));
        }
    }

    /**
     * 删除古今
     * 七星瓢虫
     * 2018/12/16
     */
    public function del(Request $request){
        if($request->isMethod('post')){
            if(DB::delete("delete from bg_history where historyid=?",[$_POST['id']])){
                return json_encode(['status'=>200,'msg'=>'删除成功!']);
            }

            return json_encode(['status'=>400,'msg'=>'删除失败,未知错误,请联系管理员!']);
        }
    }

}
