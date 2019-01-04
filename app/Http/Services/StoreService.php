<?php

namespace App\Http\Services;

use App\models\StoreModel;

class StoreService
{

    /**
     * 根据用户id查询出店铺id
     * @param $uid
     * @return int
     */
    public function getStoreIdByUid($uid)
    {
        $storeModel = new StoreModel();
        $storeInfo = $storeModel::where('uid', '=', $uid)->first();
        $storeId = 0;
        if (!empty($storeInfo)) {
            $storeId = $storeInfo->id;
        }
        return $storeId;
    }

}

