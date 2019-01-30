<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use ClassPreloader\Config;
use Illuminate\Http\Request;
use App\models\UserModel;
use App\models\StoreModel;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Cookie;
use App\Http\Services\ValidateCodeService;

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
        $isRight = ValidateCodeService::checkValidate($request, $code);

        if (!$isRight) {
            return $this->fail(50000);
        }

        $userModel = new UserModel();
        $re = $userModel::where('mobile', $mobile)->where('password', $password)->first();


        if ($re) {
            $data = $re->toArray();
            $data['grade_name'] = UserService::getGrade($data['score']);
            $store_id = StoreModel::where('uid', $data['id'])->select('id', 'status')->first();
            if ($store_id) {
                $data['store_id'] = $store_id['id'];
                $data['store_status'] = $store_id['status'];
            } else {
                $data['store_id'] = 0;
                $data['store_status'] = 3;//写死
            }
            //登录成功之后把用户信息存入session
            $request->session()->put('userInfo', $data);
            //登录成功之后把用户信息存入cookie
            Cookie::queue('info', $data);
            Cookie::queue('uid', $data['id'],$minutes = 5*86400, $path = null, $domain = null, $secure = false, $httpOnly = false);
            return $this->success();
        } else {
            return $this->fail(50001);
        }
        //1.输入手机号+密码+验证码
        //2.手机号+短信验证码
    }

    /**
     * 退出登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $re = $request->session()->forget('userInfo');
        Cookie::queue(Cookie::forget("info"));
        if ($re) {
            return $this->success();
        } else {
            return $this->fail(300);
        }
    }




}