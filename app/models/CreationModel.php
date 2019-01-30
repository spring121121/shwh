<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreationModel extends Model
{
    /**
     * 入围
     */
    const IS_CHOICE_1 = 1;
    /**
     * 没入围
     */
    const IS_CHOICE_0 = 0;
    //软删除 通过 deleted_at 字段区分是否删除，删除时调用 $table->softDeletes();

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'creation';
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
    protected $fillable = ['uid','creation_urls','demand_id','introduction','is_choice'];

}
