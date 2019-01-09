<?php

namespace App\Http\Services;




class ValidateCodeService
{
    public static function checkValidate($request,$code)
    {

        $sessionCode = $request->session()->get('validateCode');

        $request->session()->put('validateCode','');
        if (strtolower($code) == $sessionCode) {
            return true;
        }else{
            return false;
        }
    }

}

