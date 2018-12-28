<?php

namespace App\Http\Services;




class UserService
{
    public static function getUid($request)
    {
        $userInfo = $request->session()->get('userInfo');
//        $uid = $userInfo['id'];
        $uid = 1;
        return $uid;
    }

}

