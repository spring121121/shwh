<?php

namespace App\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:31
 */
class BaseController extends Controller
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'appid' => 'wx1dc64acc9bd9eb09',
            'app_secret' => '18030345ebbbc089f628a5eb1db5cda3',
            'mch_id' => '1490402642',
            'appkey' => 'TIANJINTAOCIYUAN20190111SHWHCOPY',
            'sslcert_path' => '/var/www/html/public/cert/apiclient_cert.pem',
            'sslkey_path' => '/var/www/html/public/cert/apiclient_key.pem'
        ];
    }

    public function success($data = [],$total='')
    {
        return response()->json([
            'status' => true,
            'code' => 200,
            'total'=>$total,
            'message' => config('errorcode.code')[200],
            'data' => $data,
        ]);
    }

    public function fail($code, $data = [], $message = null)
    {
        return response()->json([
            'status' => false,
            'code' => $code,
            'message' => isset($message) ? $message : config('errorcode.code')[$code],
            'data' => $data,
        ]);
    }
}