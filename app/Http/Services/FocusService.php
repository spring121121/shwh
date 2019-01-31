<?php

namespace App\Http\Services;

use App\models\FocusModel;

class FocusService
{

    /**
     * 查询当前登录用户是不是关注过某用户
     * @param $loginUid
     * @param $beuid
     * @return bool
     */
    public function judgeIsFocus($loginUid, $beuid)
    {

        $beFocusArr = FocusModel::where('uid', $loginUid)->select("beuid")->get()->toArray();
        $beUidArr = array_column($beFocusArr, "beuid");

        if (in_array($beuid, $beUidArr)) {
            //查询登录的用户是否关注了这个设计师
            return true;
        } else {
            return false;
        }


    }


}

