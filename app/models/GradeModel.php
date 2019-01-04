<?php

namespace App\models;

class GradeModel extends BaseModel
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'score_grade';
    protected $primaryKey = 'id';
    /**
     * 指定是否模型应该被戳记时间。
     * 自动维护 created_at 和 updated_at字段 每个表必有的字段
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var 字段在这里填写
     */
    protected $fillable = ['role', 'min_score','max_score','grade_name'];

//    public static function find()
//    {
//        self::_find();
//    }

    public function message()
    {

    }
}
