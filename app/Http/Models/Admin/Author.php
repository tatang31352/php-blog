<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'bg_about_author';

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
        $id = $this->attributes['id'];
        $data = '<a class="layui-btn upd" href="/admin/author/upd?id='.$id.'"'.' style="height:80px;line-height:28px;" >编辑</a> <a style="height:80px;line-height:28px;" class="layui-btn del">删除</a>';
        return $data;
    }

    /**
     * 访问器
     * 图片
     * 2018/12/11
     */
    public function getImgAttribute($value)
    {
        $data = '<img src="'.$value.'"'.'/>';
        return $data;
    }




}
