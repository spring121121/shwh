<?php

namespace App\models;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends BaseModel
{
    //软删除 通过 deleted_at 字段区分是否删除，删除时调用 $table->softDeletes();
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'user';
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
    protected $fillable = ['name', 'nickname', 'password', 'sex', 'photo', 'birthday', 'mobile', 'score'];

//    public static function find()
//    {
//        self::_find();
//    }

    public function message()
    {

    }
}
