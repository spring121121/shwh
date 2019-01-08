<?php

namespace App\Http\Services;




class ValidateCodeService
{
    public static function checkValidate($request,$code)
    {
        echo $code;
        $sessionCode = $request->session()->get('validateCode');
echo "---------------------";
        echo $sessionCode;
        $request->session()->put('validateCode','');
        if (strtolower($code) == $sessionCode) {
            return true;
        }else{
            return false;
        }
    }

}

