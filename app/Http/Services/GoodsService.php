<?php

namespace App\Http\Services;

use App\models\GoodsModel;

class GoodsService
{

    /**
     * 代理一个商品，即将一个商品加入我的店铺
     * @param $request
     * @param $pgoodsId
     * @param $storeId
     * @return bool
     */
    public function addAgentGoods($request,$pgoodsId,$storeId)
    {

        //先根据$pgoodsId查询
        $goodsModel = new GoodsModel();
        $pgoodsInfo = $goodsModel::find($pgoodsId);

        //往goods表里插入一条数据
        $goodsModel->store_id = $storeId;
        $goodsModel->goods_name = $request->input('goods_name');
        $goodsModel->goods_info = $pgoodsInfo->goods_info;
        $goodsModel->price = $request->input('price') ;
        $goodsModel->image_url = $pgoodsInfo->image_url;
        $goodsModel->stock = $pgoodsInfo->stock;
        $goodsModel->is_shipping = $pgoodsInfo->is_shipping;
        $goodsModel->postage = $pgoodsInfo->postage;
        $goodsModel->is_agent = GoodsModel::IS_AGENT_1;
        $goodsModel->be_agent = GoodsModel::DONT_BE_AGENT;
        $goodsModel->pgoods_id = $pgoodsId;
        if($goodsModel->save()){
            return true;
        }else{
            return false;
        }

    }

}

