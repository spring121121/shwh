<?php

namespace App\models;

use Illuminate\Database\Eloquent\SoftDeletes;

class FocusModel extends BaseModel
{
    CONST LIMIT = 3;//推荐列表显示条数
    CONST IS_FOCUS = 1;//已关注
    CONST NO_FOCUS = 0;//未关注
    //软删除 通过 deleted_at 字段区分是否删除，删除时调用 $table->softDeletes();
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'focus';
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
    protected $fillable = ['uid', 'beuid'];

//    public static function find()
//    {
//        self::_find();
//    }

    public function message()
    {

    }
}
