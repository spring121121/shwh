<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use ValidateCode;

class ValidateCodeController extends BaseController
{
    /**
     * 获取验证码图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCodeImg(Request $request)
    {

        $codeClass = new ValidateCode();
        $code = $codeClass->doimg();

        //把验证码放入seesion中
        $request->session()->put('validateCode', $codeClass->getCode());
        $request->session()->save();
        return $this->success($code);

    }

    /**
     * 验证输入的验证码是否正确
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkValidateCode(Request $request)
    {
        $sessionCode = $request->session()->get('validateCode');
        $code = $request->input('code');
        if ($sessionCode == $code) {
            return $this->success();
        } else {
           return  $this->fail(50000);
        }
    }


}