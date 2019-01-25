<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */
namespace App\Http\Controllers;
header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Sendsms;
class SmsController extends BaseController
{
    public function sendSms(Request $request) {
        $sms = new Sendsms();
        $post = $request->all();
        if(!isset($post['tel'])) {
            return $this->fail(70000,'手机号不能为空');
        }
        $tel = $post['tel'];
        if(!preg_match('/^1[34578]\d{9}$/',$tel)) {
            return $this->fail(70005,'手机号不合法');
        }
        $exist = Db::table('verify')->where('tel',$tel)->first();
        if($exist && (time() - $exist->create_time) < 60) {
            return $this->fail(70006,'1分钟内不可重复发送');
        }
        $param = [
            'tel' => $tel,
            'code' => mt_rand(100000,999999)
        ];
        $res = $sms->send($param);
        if($res->Code === 'OK') {
            $param['create_time'] = time();
            try {
                if($exist) {
                    Db::table('verify')->where('tel',$tel)->update($param);
                }else {
                    Db::table('verify')->insert($param);
                }
            }catch (\Exception $e) {
                return $this->fail(300,$e->getMessage());
            }
            return $this->fail(200);
        }else {
            return $this->fail(300,$res->Message);
        }
    }

    public function bindTel(Request $request) {
        $data['tel'] = $request->input('tel');
        $data['code'] = $request->input('code');
        if(!check_post($data)) {
            return $this->fail(70000,$data);
        }
        if(!preg_match('/^1[34578]\d{9}$/',$data['tel'])) {
            return $this->fail(70005,'手机号不合法');
        }
        $userinfo = $request->session()->get('userInfo');
        if(!$userinfo) {
            return $this->fail(70001);
        }
        $map = ['tel'=>$data['tel'],'code'=>$data['code']];
        $exist = Db::table('verify')->where($map)->first();
        if(!$exist) {
            return $this->fail(70002);
        }
        if((time() - $exist->create_time) > 300) {
            return $this->fail(70003);
        }
        $tel_exist = Db::table('user')->where('mobile',$data['tel'])->first();
        if($tel_exist) {
            return $this->fail(70004);
        }
        try {
            Db::table('user')->where('id',$userinfo['id'])->update(['mobile'=>$data['tel']]);
        }catch (\Exception $e) {
            return $this->fail(300,$e->getMessage());
        }
        return $this->success();
    }
}