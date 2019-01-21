<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategorygoodsModel extends Model
{
    CONST GOODS_ALL = 0;//所有分类，即所有商品
    CONST ONE_CATEGORY = 0;//一级分类类
    CONST SON_CATEGORY = 1;//二级分类
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'category_goods';
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
    protected $fillable = ['category_id','goods_id'];
}
