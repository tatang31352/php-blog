<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'bg_users';

    /**
     * 指定主键
     */
    protected $primaryKey = 'id';


     /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 创建操作字段
     * 七星瓢虫
     * 2018/10/24
     */
    protected $appends = ['operation'];
    public function getOperationAttribute()
    {
        $qq = $this->attributes['is_qq'];
        $id = $this->attributes['id'];
        if($qq){
        	$data = '<a style="height:80px;line-height:28px;text-align:center;" class="layui-btn del" >删除</a>';
        }else{
        	$data = '<a class="layui-btn upd" href="/admin/user/upd?id='.$id.'"'.' style="height:80px;line-height:28px;" >编辑</a> <a style="height:80px;line-height:28px;" class="layui-btn del" >删除</a>';
        }
        return $data;
    }


    /**
     * 访问器
     * 是否开启
     * 七星瓢虫
     * 2018/10/24
     */
    public function getStatusAttribute($value)
    {
        $value ? $value ='<input type="checkbox" checked value="0" field="open" name="switch" lay-skin="switch">' : $value ='<input field="open" type="checkbox" value="1" name="switch" lay-skin="switch">';
       
        return ucfirst($value);
    }

    /**
     * 访问器
     * 头像
     * 2018/12/11
     */
    public function getHeadurlAttribute($value)
    {
        $data = '<img src="'.$value.'"'.'/>';
        return $data;
    }

    /**
     * 是否qq
     * 图片
     * 2018/12/11
     */
    public function getIsQqAttribute($value)
    {
        return $value ? 'QQ账号' : '普通账号';
    }


    public function getCreateTimeAttribute($value)
    {
        $value = date('Y-m-d H:i',$value);
        return ucfirst($value);
    }
    public function getEndtimeAttribute($value)
    {
        $value = date('Y-m-d H:i',$value);
        return ucfirst($value);
    }
}
