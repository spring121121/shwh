<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdersModel extends Model
{
    CONST IS_ALL = -2;//所有
    CONST NOT_PAY = 0;//待支付
    CONST IS_PAY = 1;//已支付（支付成功，支付失败）
    CONST IS_DELIVER = 3;//已发货
    CONST NOT_COMMENT = 6;//待评价

    CONST IS_PAYMENT = 2;//支付成功
    CONST IS_RECEIVE = 4;//已签收

    CONST NOT_REFUND_APPLY = 0;//未申请退款
    CONST IS_REFUND_APPLY = 1;//申请退款
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'orders';
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
    protected $fillable = ['uid','agent_uid','store_id','agent_price','order_sn','trans_id','goods_id','num','unit_price','total_price','status','is_agent','address_id','refund_apply'];
}
