<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\models\UserModel;

class LoginController extends BaseController
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required',
            'password' => 'required',
            'code' => 'required',
        ]);
        $mobile = $request->input('mobile');
        $password = md5($request->input('password'));
        $code = $request->input('code');
        $sessionCode = $request->session()->get('validateCode');

        if (strtolower($code) != $sessionCode) {
            return $this->fail(50000);
        }

        $userModel = new UserModel();
        $re = $userModel::where('mobile', $mobile)->where('password', $password)->first();


        if ($re) {
            //登录成功之后把用户信息存入session
            $request->session()->put('userInfo',$re->toArray());
            return $this->success();
        } else {
            return $this->fail(50001);
        }
        //1.输入手机号+密码+验证码
        //2.手机号+短信验证码
    }


}