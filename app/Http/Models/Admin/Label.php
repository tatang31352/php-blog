<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    /**
    * 与模型关联的数据表
    *
    * @var string
    */
    protected $table = 'bg_label';

    /**
     * 指定主键
     */
    protected $primaryKey = 'label_id';


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
        $id = $this->attributes['label_id'];
        $data = '<a class="layui-btn upd" href="/admin/label/upd?id='.$id.'"'.' style="height:80px;line-height:28px;" >编辑</a> <a style="height:80px;line-height:28px;" class="layui-btn del">删除</a>';
        return $data;
    }

    /**
     * 访问器
     * 性别
     * 七星瓢虫
     * 2018/12/12
     */
    public function getColorAttribute($value)
    {
        $value = '<button type="button" style="height:60px;width:60px;'.$value. '"></button>';

        return ucfirst($value);
    }
}
