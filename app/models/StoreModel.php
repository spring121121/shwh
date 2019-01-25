<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreModel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    CONST IS_AUTH = 1;//已认证
    CONST IS_NOT_AUTH = 0;//未认证
    CONST STORE_STATUS = 3;//无实际意义
    CONST STORE_ID = 0;//store_id默认为0
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'store';
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
    protected $fillable = ['name','uid','introduction','logo_pic_url','prove_url','real_name','id_card_num','id_card_front','id_card_backend','	auth_id','auth_id'];
}
