<?php

namespace App\models;

use Illuminate\Database\Eloquent\SoftDeletes;

class SysmessageModel extends BaseModel
{
    CONST IS_READ = 1;//已读
    CONST UN_READ = 0;//未读

    //软删除 通过 deleted_at 字段区分是否删除，删除时调用 $table->softDeletes();
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'sys_message';
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
    protected $fillable = ['pub_user_id', 'receive_user_id', 'title', 'content','is_read'];

//    public static function find()
//    {
//        self::_find();
//    }

    public function message()
    {

    }
}
