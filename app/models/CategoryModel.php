<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'category';
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
    protected $fillable = ['category_name','pid','is_shop'];
}
