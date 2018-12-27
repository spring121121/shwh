<?php


return [

    /*
    |--------------------------------------------------------------------------
    | customized http code
    |--------------------------------------------------------------------------
    |
    | The first number is error type, the second and third number is
    | product type, and it is a specific error code from fourth to
    | sixth.But the success is different.
    |
    */

    'code' => [
        200 => '成功',
        300 => '失败',
        50000=>'验证码输入错误',
        50001=>'输入信息错误',
        50002=>'参数错误',

    ],

];