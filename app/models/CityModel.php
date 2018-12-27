<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'cities';
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
    protected $fillable = ['cityid','city','provinceid'];
}
