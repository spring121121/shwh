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
    ],

    'goods' => [//商品表
        'goods_name.required' => '商品名称不能为空',
        'goods_name.max' => '商品名称最多:max个字符',
        'goods_info.required' => '商品简介不能为空',
        'goods_info.max' => '商品简介最多:max个字符',
        'price.required' => '商品价格不能为空',
        'image_one.required' => '商品第一张图不能为空',
        'image_two.required' => '商品第二张图不能为空',
        'image_three.required' => '商品第三张图不能为空',
        'image_four.required' => '商品第四张图不能为空',
        'stock.required' => '商品库存不能为空',
        'is_shipping.required' => '商品是否包邮不能为空',
        'postage.required' => '商品邮费不能为空'
    ],

];