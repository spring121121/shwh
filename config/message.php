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

    'sys_message' => [
        'title.required' => '标题不能为空',
        'title.max' => '标题最多:max个字符',
        'content.required' => '标题不能为空',
        'content.max' => '标题最多:max个字符',
    ],

];