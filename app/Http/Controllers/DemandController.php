<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 19-1-25
 * Time: 下午1:24
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\models\DemandModel;
use Validator;
use App\Http\Services\DemandService;
class DemandController extends BaseController
{

    /**
     * 添加一个需求
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addDemand(Request $request)
    {
        $uid = UserService::getUid($request);
        $rules = [
            'demand_url'=>'required',
            'title'=>'required',
            'content'=>'required',
            'bonus'=>'required|numeric',
            'start_time'=>'required|date_format:"Y-m-d H:i:s"',
            'end_time'=>'required|date_format:"Y-m-d H:i:s"|after:start_time',
        ];

        $validator = Validator::make($request->all(), $rules,config('message.demand'));
        if ($validator->fails()) {
            return $this->fail(50001, '', $validator->errors()->all()[0]);
        }
        $dataAll = $request->all();

        $demandModel = new DemandModel();
        $demandModel->uid = $uid;
        $demandModel->demand_url=$dataAll['demand_url'];
        $demandModel->title=$dataAll['title'];
        $demandModel->content=$dataAll['content'];
        $demandModel->bonus=$dataAll['bonus'];
        $demandModel->start_time=$dataAll['start_time'];
        $demandModel->end_time=$dataAll['end_time'];

        $re = $demandModel->save();
        if($re){
            return $this->success();
        }else{
            return $this->fail(300);
        }


    }

    /**
     * 获取我发布的需求列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyDemandList(Request $request)
    {
        $page = $request->input('page',1);
        $limit = $request->input('limit',20);
        $skip = ($page-1)*$limit;
        $uid = UserService::getUid($request);
        $demandService = new DemandService();
        $demandList = $demandService->getDemandList($uid,'',$skip,$limit);

        return $this->success($demandList);
    }

    /**
     * 获取别人发布的需求
     * @param Request $request
     * @param $uid
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDemandListByUid(Request $request,$uid){
        $page = $request->input('page',1);
        $limit = $request->input('limit',20);
        $skip = ($page-1)*$limit;
        $demandService = new DemandService();
        $demandList = $demandService->getDemandList($uid,'',$skip,$limit);

        return $this->success($demandList);
    }

    /**
     * 获取某个需求的详细信息
     * @param $demendId
     * @return mixed
     */
    public function getDemandDetail($demendId)
    {
        $demandService = new DemandService();
        $demandDetail = $demandService->getDemandDetail($demendId);

        return $this->success($demandDetail);
    }

    /**
     * 获取需求列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDemandList(Request $request)
    {
        $page = $request->input('page',1);
        $limit = $request->input('limit',20);
        $skip = ($page-1)*$limit;
        $searchContent = $request->input("searchContent",'');
        $demandService = new DemandService();
        $demandList = $demandService->getDemandList('',$searchContent,$skip,$limit);

        return $this->success($demandList);
    }
}