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
use App\Http\Services\ValidateCodeService;
use Validator;

class RegisterController extends BaseController
{

    /**
     * 1.输入手机号 +验证码+密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $rules = [
            'mobile' => 'required|regex:/^1[34578][0-9]{9}$/|unique:user,mobile',
            'password' => 'required',
            'password_again' => 'required',
            'code' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules, config('message.user'));

        if ($validator->fails()) {
            return $this->fail(50001, '', $validator->errors()->all()[0]);
        }


        $code = $request->input('code');
        $isRight = ValidateCodeService::checkValidate($request, $code);

        if (!$isRight) {
            return $this->fail(50000);
        }
        $mobile = $request->input('mobile');
        $password = $request->input('password');
        $password_again = $request->input('password_again');

        if ($password != $password_again) {
            return $this->fail(50004);
        }


        $userModel = new UserModel();
        $userModel->mobile = $mobile;
        $userModel->password = md5($password);

        $re = $userModel->save();

        if ($re) {
            return $this->success();
        } else {
            return $this->fail(50001);
        }


    }

    /**
     * 2.微信注册
     * @param $
     */
    public function registerWchat()
    {

    }


}