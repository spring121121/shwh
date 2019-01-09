<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Services\AgentService;
use App\Http\Services\UserService;
use App\Http\Services\StoreService;
use App\Http\Services\GoodsService;
use Validator;

class AgentController extends BaseController
{
    public function addAgentGoods(Request $request)
    {
        $rules = [
            'goods_id' => 'required|integer',
            'goods_name' => 'required|string',
            'price' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->fail(50001, $validator->errors()->all());
        }
        $goodsId = $request->input('goods_id');

        //1.检验该产品是否是允许代理的
        $agentService = new AgentService();
        $isAgent = $agentService->checkIsBeAgent($goodsId);
        if (!$isAgent) {
            return $this->fail(50003);
        }

        //2.查询用户的店铺ID
        $uid = UserService::getUid($request);
        $storeService = new StoreService();
        $storeInfo = $storeService->getStoreIdByUid($uid);

        if(empty($storeInfo)){
            return $this->fail(50005);

        }
        if($storeInfo->status == 0){
            return $this->fail(50006);
        }
        //3.插入商品表
        $goodsService = new GoodsService();
        $re = $goodsService->addAgentGoods($request,$goodsId,$storeInfo->id);

        if($re){
            return $this->success();
        }else{
            return $this->fail(300);
        }

    }


}