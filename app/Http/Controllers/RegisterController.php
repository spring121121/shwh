<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class RegisterController extends BaseController
{

    /**
     * 1.输入手机号 +验证码+密码
     * @param Request $request
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|regex:/^1[34578][0-9]{9}$/',
            'password'=>'required',
            'code'=>'required'
        ]);



    }

    /**
     * 2.微信注册
     * @param $
     */
    public function registerWchat()
    {

    }



}