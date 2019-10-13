<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    /**
    * 与模型关联的数据表
    *
    * @var string
    */
    protected $table = 'bg_history';

    /**
     * 指定主键
     */
    protected $primaryKey = 'historyid';


     /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * 创建操作字段
     * 七星瓢虫
     * 2018/12/12
     */
    protected $appends = ['operation'];
    public function getOperationAttribute()
    {
        $id = $this->attributes['historyid'];
        $data = '<a class="layui-btn upd" href="/admin/history/upd?id='.$id.'"'.' style="height:80px;line-height:28px;" >编辑</a> <a style="height:80px;line-height:28px;" class="layui-btn del">删除</a>';
        return $data;
    }

    /**
     * 访问器
     * 性别
     * 七星瓢虫
     * 2018/12/12
     */
    public function getContentAttribute($value)
    {

        $value = json_decode($value,true)[0]['content'];

        return substr($value,0,100);
    }

     /**
     * 访问器
     * 性别
     * 七星瓢虫
     * 2018/12/12
     */
    public function getCreateTimeAttribute($value)
    {

       	$value = date('Y-m-d H:i:s',$value); 	

        return $value;
    }


    /**
     * 访问器
     * 性别
     * 七星瓢虫
     * 2018/12/12
     */
    public function getUserIdAttribute($value)
    {

       	$value = DB::SELECT("SELECT username FROM bg_user WHERE userid = ?",[$value]);

       	$value ? $value = $value[0]['username'] : $value = '未关联账户';	

        return $value;
    }

}
