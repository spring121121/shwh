<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressModel extends Model
{
    use SoftDeletes;
    /**
     * 不是默认的地址
     */
    const IS_DEFAULT_0 = 0;
    /**
     * 是默认的地址
     */
    const IS_DEFAULT_1 = 1;
    protected $dates = ['deleted_at'];
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'address';
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
    protected $fillable = ['uid', 'name', 'province', 'city', 'area', 'address_info', 'mobile','is_default'];
}
