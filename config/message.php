<?php


return [

    /*
    |--------------------------------------------------------------------------
    | 校验信息返回数组
    |--------------------------------------------------------------------------
    |
    | 键：表名
    | 值：校验不合格返回的内容
    | 调用示例
    | $rules = [
    |        'mobile' => 'required|regex:/^1[34578][0-9]{9}$/|unique:user,mobile',
    |       'password' => 'required',
    |      'password_again' => 'required',
    |        'code' => 'required'
    |    ];
    | $validator = Validator::make($request->all(), $rules, config('message.user'));
    |   if ($validator->fails()) {
    |        return $this->fail(50001, '', $validator->errors()->all()[0]);
    |    }
    |
    */


    'user' => [
        'mobile.unique' => '该手机号已被注册',
        'mobile.regex' => '请输入正确的手机号格式',
    ],

    'sys_message' => [//系统消息表
        'title.required' => '标题不能为空',
        'title.max' => '标题最多:max个字符',
        'content.required' => '内容不能为空',
        'content.max' => '内容最多:max个字符',
    ],

    'dis_message' => [//评论表
        'content.required' => '评论内容不能为空',
        'content.max' => '评论内容最多:max个字符',
    ],

    'feedback' => [//意见反馈表
        'feedback.required' => '意见反馈不能为空',
        'feedback.max' => '意见反馈最多:max个字符',
    ],

    'store' => [//店铺表
        'name.required' => '店铺名称不能为空',
        'name.max' => '店铺名称最多:max个字符',
        'introduction.required' => '店铺简介不能为空',
        'introduction.max' => '店铺简介最多:max个字符',
        'logo_pic_url' => '店铺logo不能为空',
        'prove_url' => '店铺资质证明不能为空',
        'real_name.required'=>"请输入店主的真实姓名",
        'id_card_num.required'=>"请输入身份证号",
        'id_card_front.required'=>"请上传身份证正面",
        'id_card_backend.required'=>"请上传身份证背面",
    ],

    'goods' => [//商品表
        'goods_name.required' => '商品名称不能为空',
        'goods_name.max' => '商品名称最多:max个字符',
        'goods_info.required' => '商品简介不能为空',
        'goods_info.max' => '商品简介最多:max个字符',
        'price.required' => '商品价格不能为空',
        'image_url.required' => '商品图不能为空',
        'stock.required' => '商品库存不能为空',
        'is_shipping.required' => '商品是否包邮不能为空',
        'postage.required' => '商品邮费不能为空'
    ],

    'order' => [//订单表
        'goods_id.required' => '购买商品不能为空',
        'goods_id.numeric' => '商品类型为数字',
        'num.required' => '购买数量不能为空',
        'num.numeric' => '数量类型为数字',
        'store_id.required' => '购买商品所属商店不能为空',
        'store_id.numeric' => '购买商品所属商店类型为数字',
        'unit_price.required' => '购买单价不能为空',
        'unit_price.numeric' => '单价类型为数字',
        'is_agent.required' => '是否从代理购买不能为空',
        'is_agent.numeric' => '是否从代理购买类型为数字',
    ],

    'browse_record' => [//浏览表
        'type.required' => '浏览类型不能为空',
        'browse_id.required' => '浏览id类型为数字',
    ],

    'withdraw_cash' => [//申请取现表
        'apply.required' => '申请金额不能为空',
        'apply.numeric' => '申请金额类型为数字',
    ],

    'comment' => [//评论表
        'to_cid.required' => '回复的人不能为空',
        'to_cid.numeric' => '回复的人类型为数字',
        'note_id.required' => '笔记不能为空',
        'note_id.numeric' => '笔记类型为数字',
        'content.required' => '回复的内容不能为空',
        'content.max' => '回复的内容最多:max个字符',
        'comment_id.required' => '回复的评论id不能为空',
        'comment_id.numeric' => '回复的评论id类型为数字',
    ],

    'likes' => [//笔记点赞表
        'note_id.required' => '点赞笔记不能为空',
        'note_id.numeric' => '点赞笔记类型为数字',
    ],

    'forward' => [//笔记转发表
        'note_id.required' => '转发笔记不能为空',
        'note_id.numeric' => '转发笔记类型为数字',
    ],

    'collect' => [//笔记收藏表
        'note_id.required' => '收藏笔记不能为空',
        'note_id.numeric' => '收藏笔记类型为数字',
    ],
    'demand'=>[
        'demand_url.required'=>'需求首图不能为空',
        'title.required'=>'需求标题不能为空',
        'content.required'=>'需求内容不能为空',
        'bonus.required'=>'奖金不能为空',
        'bonus.numeric'=>'奖金格式不正确',
        'start_time.required'=>'需求开始时间不能为空',
        'start_time.date_format'=>'需求开始时间格式不正确',
        'end_time.required'=>'需求结束时间不能为空',
        'end_time.date_format'=>'需求结束时间格式不正确',
        'end_time.after'=>'需求结束时间必须晚于开始时间',
    ],
    'demandCreation'=>[
        'creation_urls.required'=>'请上传您的作品',
        'demand_id.required'=>'需求id不能为空',
        'introduction.required'=>'作品介绍不能为空',
    ]
];