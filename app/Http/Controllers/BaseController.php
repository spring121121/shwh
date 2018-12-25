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

    public function success($data = [])
    {
        return response()->json([
            'status' => true,
            'code' => 200,
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