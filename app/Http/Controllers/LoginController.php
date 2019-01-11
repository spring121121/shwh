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
        $isRight = ValidateCodeService::checkValidate($request,$code);

        if (!$isRight) {
            return $this->fail(50000);
        }

        $userModel = new UserModel();
        $re = $userModel::where('mobile', $mobile)->where('password', $password)->first();


        if ($re) {
            $data = $re->toArray();
            $data['grade_name']= UserService::getGrade($data['score']);
            $store_id = StoreModel::where('uid',$data['id'])->select('id')->first();
            if($store_id){
                $data['store_id'] = $store_id['id'];
            }else{
                $data['store_id'] = 0;
            }
            //登录成功之后把用户信息存入session
            $request->session()->put('userInfo',$data);
            //登录成功之后把用户信息存入cookie
            Cookie::queue('info',$data,120);//120分钟
            return $this->success();
        } else {
            return $this->fail(50001);
        }
        //1.输入手机号+密码+验证码
        //2.手机号+短信验证码
    }


}