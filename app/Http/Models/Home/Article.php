<?php

namespace App\Http\Models\Home;

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
    protected $fillable = ['category_id'];

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
     * 创建操作字段
     * 七星瓢虫
     * 2018/10/24
     */
    protected $appends = ['comment'];
    public function getCommentAttribute()
    {
        $a_id = $this->attributes['article_id'];
        $data = DB::table('bg_comment')->where('article_id',$a_id)->count();
        return $data;
    }

    /**
     * 文章详情
     * 七星瓢虫
     * 2018/10/24
     */
    public static  function detail($id,$userid)
    {
        //阅读数自增
        DB::table('bg_article')->where(['article_id'=>$id])->increment('read');
        $data = self::where('user_id',$userid)->find($id)->toArray();
        // $data = self::find($id)->toArray();
        $data['category_id'] = DB::SELECT('select category from bg_category where category_id = ?',[$data['category_id']])[0]['category'];

        //上一篇文章
        $data['prev']=DB::table('bg_article')
        ->select('title','article_id')
        ->where('user_id',$userid)
        ->where('article_id','<',$id)
        ->where('del',0)
        ->where('lock',1)
        ->orderBy('article_id','desc')
        ->limit(1)
        ->get()->toArray();

        //下一篇文章
        $data['next']=DB::table('bg_article')
        ->select('title','article_id')
        ->where('user_id',$userid)
        ->where('article_id','>',$id)
        ->where('del',0)
        ->where('lock',1)
        ->orderBy('article_id','asc')
        ->limit(1)
        ->get()->toArray();


        return $data;
    }


    
 

  










}
