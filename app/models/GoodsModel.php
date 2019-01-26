<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsModel extends Model
{
    /**
     * 不是代理
     */
    const IS_AGENT_O = 0;
    /**
     * 是代理
     */
    const IS_AGENT_1 = 1;

    CONST RELATE_GOODS = 10;//随机相关商品条数
    CONST UNDERCARRIAGE = 0;//商品下架
    CONST NORMAL = 1;//商品正常

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'goods';
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
    protected $fillable = ['store_id','goods_name','goods_info','price','image_url','stock','is_shipping','postage','is_agent','pgoods_id',];
}
