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
use App\Http\Services\ValidateCodeService;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;


class ValidateCodeController extends BaseController
{
    /**
     * 获取验证码图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCodeImg(Request $request)
    {

        $ip = $request->getClientIp();
        if (!Cache::has($ip)) {
            $expiresAt = Carbon::now()->addMinutes(ValidateCodeService::CODE_TIME);
            Cache::put($ip,0,$expiresAt);//缓存有效期5分钟
        }

        //1.先检测一下该IP是否是频繁获取
        if (Cache::get($ip) >= ValidateCodeService::CODE_NUM) {//一个IP请求次数的限制
            return $this->fail(50004);
        }
        $codeClass = new ValidateCode();
        $code = $codeClass->doimg();

        //把验证码放入seesion中
        $request->session()->put('validateCode', $codeClass->getCode());
        $request->session()->save();
        //记录一次cache
        Cache::increment($ip);

        return $this->success($code);

    }

    /**
     * 验证输入的验证码是否正确
     * @param Request $request
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkValidateCode(Request $request, $code)
    {

        $isRight = ValidateCodeService::checkValidate($request, $code);

        if ($isRight) {
            return $this->success();
        } else {
            return $this->fail(50000);
        }
    }


}