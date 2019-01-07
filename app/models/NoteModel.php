<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class NoteModel extends Model
{
    //软删除 通过 deleted_at 字段区分是否删除，删除时调用 $table->softDeletes();
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'note';
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
    protected $fillable = ['uid','title','content','image_one_url','image_two_url','image_three_url','goods_id'];
}
