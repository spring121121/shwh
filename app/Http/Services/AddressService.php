<?php

namespace App\Http\Services;


use App\models\AddressModel;
use App\models\GradeModel;

class AddressService
{
    public static function updateNotDefault($uid)
    {
        $addressModel = new AddressModel();
        $update = ['is_default'=>AddressModel::IS_DEFAULT_0];
        $addressModel::where('uid','=',$uid)->update($update);

    }
}

