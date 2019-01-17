<?php

namespace App\models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ScoreModel extends BaseModel
{
    //类型
    CONST COMMENT_TYPE = 0;//评论
    CONST FORWARD_TYPE = 1;//转发
    CONST LIKES_TYPE = 2;//点赞
    CONST COLLECT_TYPE = 3;//收藏
    CONST PURCHASE_TYPE = 4;//购买
    //积分
    CONST COMMENT_SCORE = 10;//评论所获积分
    CONST FORWARD_SCORE = 20;//转发所获积分
    CONST LIKES_SCORE = 30;//点赞所获积分
    CONST COLLECT_SCORE = 40;//收藏所获积分
    CONST PURCHASE_SCORE = 50;//购买所获积分
    //软删除 通过 deleted_at 字段区分是否删除，删除时调用 $table->softDeletes();
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'score';
    protected $primaryKey = 'id';
    /**
     * 指定是否模型应该被戳记时间。
     * 自动维护 created_at 和 updated_at字段 每个表必有的字段
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var 字段在这里填写
     */
    protected $fillable = ['uid', 'type','score'];

//    public static function find()
//    {
//        self::_find();
//    }

    public function message()
    {

    }
}
