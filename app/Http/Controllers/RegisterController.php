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

class RegisterController extends BaseController
{

    /**
     * 1.输入手机号 +验证码+密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|regex:/^1[34578][0-9]{9}$/',
            'password' => 'required',
            'password_again' => 'required',
            'code' => 'required'
        ]);

        $code = $request->input('code');
        $isRight = ValidateCodeService::checkValidate($request,$code);

        if (!$isRight) {
            return $this->fail(50000);
        }
        $mobile = $request->input('mobile');
        $password = $request->input('password');
        $password_again = $request->input('password_again');

        if ($password != $password_again) {
            return $this->fail(50001);
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