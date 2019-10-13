<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Article extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'bg_article';

    /**
     * 指定主键
     */
    protected $primaryKey = 'article_id';


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
        $id = $this->attributes['article_id'];
        $data = '<a class="layui-btn upd" href="/admin/article/upd?id='.$id.'"'.' style="height:80px;line-height:28px;" >编辑</a> <a style="height:80px;line-height:28px;" class="layui-btn del" >删除</a>';
        return $data;
    }

    /**
     * 访问器
     * 是否启用
     * 七星瓢虫
     * 2018/10/24
     */
    public function getLockAttribute($value)
    {
        $value ? $value ='<input type="checkbox" checked field="lock" value="0"  name="switch" lay-skin="switch">' : $value ='<input field="lock" type="checkbox" value="1"  name="switch"  lay-skin="switch">';

        return ucfirst($value);
    }

    /**
     * 访问器
     * 是否推荐
     * 七星瓢虫
     * 2018/10/24
     */
    public function getRecommendAttribute($value)
    {
        $value ? $value ='<input type="checkbox" checked field="recommend" value="0"  name="switch" lay-skin="switch">' : $value ='<input field="recommend" type="checkbox" value="1"  name="switch"  lay-skin="switch">';

        return ucfirst($value);
    }

    /**
     * 访问器
     * 分类名称
     * 七星瓢虫
     * 2018/10/24
     */
    public function getCategoryIdAttribute($value)
    {

        $data = DB::SELECT("SELECT category FROM bg_category WHERE category_id=?",[$value])[0]['category'];
        return ucfirst($data);
    }

    /**
     * 访问器
     * 所属账户
     * 七星瓢虫
     * 2018/10/24
     */
    public function getUserIdAttribute($value)
    {

        $data = DB::SELECT("SELECT username FROM bg_user WHERE userid=?",[$value])[0]['username'];
        return $data;
    }

    /**
     * 访问器
     * 所属账户
     * 七星瓢虫
     * 2018/10/24
     */
    public function getCreateTimeAttribute($value)
    {
        $data = date('Y-m-d H:i:s',$value);
        return $data;
    }











}
