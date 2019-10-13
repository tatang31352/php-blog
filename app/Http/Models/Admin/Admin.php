<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'bg_user';

    /**
     * 指定主键
     */
    protected $primaryKey = 'userid';


     /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;


     /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['username','password','home_id','blog_id','author_id','sex','programmer','Remarks','create_time'];



  

    /**
     * 创建操作字段
     * 七星瓢虫
     * 2018/10/24
     */
    protected $appends = ['operation'];
    public function getOperationAttribute()
    {
        $id = $this->attributes['userid'];
        $data = '<a class="layui-btn upd" href="/admin/admin/upd?id='.$id.'"'.' style="height:80px;line-height:28px;" >编辑</a> <a style="height:80px;line-height:28px;" class="layui-btn del" >删除</a>';
        return $data;
    }

    /**
     * 访问器
     * 是否为程序猿
     * 七星瓢虫
     * 2018/10/24
     */
    public function getProgrammerAttribute($value)
    {
        $value ? $value ='<input type="checkbox" checked field="programmer" value="0"  name="switch" lay-skin="switch">' : $value ='<input field="programmer" type="checkbox" value="1"  name="switch"  lay-skin="switch">';

        return ucfirst($value);
    }

    /**
     * 访问器
     * 是否开启
     * 七星瓢虫
     * 2018/10/24
     */
    public function getOpenAttribute($value)
    {
        $value ? $value ='<input type="checkbox" checked value="0" field="open" name="switch" lay-skin="switch">' : $value ='<input field="open" type="checkbox" value="1" name="switch" lay-skin="switch">';
       
        return ucfirst($value);
    }

     /**
     * 访问器
     * 性别
     * 七星瓢虫
     * 2018/10/24
     */
    public function getSexAttribute($value)
    {
        $value ? $value ='<input type="checkbox" checked value="0" field="sex" name="switch" lay-skin="switch">' : $value ='<input type="checkbox" field="sex" value="1" name="switch" lay-skin="switch">';

        return ucfirst($value);
    }





}
