<?php

namespace App\Http\Services;

use App\models\GoodsModel;

class AgentService
{
    /**
     * 查看该产品是否允许代理
     * @param $goodsId
     * @return bool  true:允许   false:不允许
     */
    public function checkIsBeAgent($goodsId)
    {

        $goodsModel = new GoodsModel();
        //is_agent = 0  说明该商品是原产品，允许被代理
        $goodsInfo = $goodsModel::where('is_agent', '=', GoodsModel::IS_AGENT_O)->find($goodsId);
//        dd($goodsInfo);
        $flag = false;
        if (!empty($goodsInfo)) {

            $flag = true;
        }
        return $flag;

    }

    public function getStoreIdByUid()
    {

    }

}

