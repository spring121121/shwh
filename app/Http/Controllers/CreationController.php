<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 19-1-25
 * Time: 下午1:24
 */

namespace App\Http\Controllers;

use App\Http\Services\CreationService;
use App\models\CreationModel;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Validator;
use Illuminate\Support\Facades\DB;

class CreationController extends BaseController
{

    /**
     * 参与需求的竞标上传我的作品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCreation(Request $request)
    {
        $uid = UserService::getUid($request);
        $rules = [
            'creation_urls' => 'required',
            'demand_id' => 'required',
            'introduction' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, config('message.demandCreation'));
        if ($validator->fails()) {
            return $this->fail(50001, '', $validator->errors()->all()[0]);
        }


        $dataAll = $request->all();

        $creationModel = new CreationModel();
        $creationModel->uid = $uid;
        $creationModel->creation_urls = $dataAll['creation_urls'];
        $creationModel->demand_id = $dataAll['demand_id'];
        $creationModel->introduction = $dataAll['introduction'];

        $re = $creationModel->save();
        if ($re) {
            return $this->success();
        } else {
            return $this->fail(300);
        }


    }

    /**
     * 获取作品列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCreationList(Request $request)
    {
        $creationService = new CreationService();
        $searchContent = $request->input('searchContent', '');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $total = DB::table('creation')->count();
        $creationList = $creationService->getCreationList($request, '', $searchContent, $page, $limit);

        return $this->success($creationList, $total);
    }

    /**
     * 获取我的作品列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyCreationList(Request $request)
    {
        $uid = UserService::getUid($request);
        $creationService = new CreationService();
        $searchContent = $request->input('searchContent');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $total = DB::table('creation')->where("uid", $uid)->count();
        $creationList = $creationService->getCreationList($request, $uid, $searchContent, $page, $limit);

        return $this->success($creationList, $total);
    }

    /**
     * 获取别人的作品列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOtherCreationList(Request $request)
    {
        $creationService = new CreationService();
        $searchContent = $request->input('searchContent');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $uid = $request->input('uid');
        $total = DB::table('creation')->where("uid", $uid)->count();
        $creationList = $creationService->getCreationList($request, $uid, $searchContent, $page, $limit);

        return $this->success($creationList, $total);
    }

    /**
     * 获取入围作品
     * @param $demandId
     * @return mixed
     */
    public function getChoiceCreationList($demandId)
    {
        $creationService = new CreationService();
        $creationInfo = $creationService->getChoiceCreationList($demandId);

        return $this->success($creationInfo);
    }

    /**
     * 获取某个需求的参赛作品
     * @param Request $request
     * @param $demandId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDemandCreationList(Request $request, $demandId)
    {
        $creationService = new CreationService();
        $total = DB::table('creation')->where("demand_id", $demandId)->count();
        $creationInfo = $creationService->getDemandCreationList($request, $demandId);

        return $this->success($creationInfo, $total);
    }

    /**
     * 获取某个作品的详细信息
     * @param $creationId
     * @return mixed
     */
    public function getCreationDetail($creationId)
    {
        $creationService = new CreationService();
        $creationInfo = $creationService->getCreationDetail($creationId);

        return $this->success($creationInfo);
    }

    /**
     * 切换入选还是不入选
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeChoice(Request $request)
    {
        $uid = UserService::getUid($request);
        $demandId = $request->input("demand_id");
        $creationId = $request->input("creation_id");

        $creationService = new CreationService();
        $flag = $creationService->judgeLoginIsDemandUid($uid,$demandId);
        if(empty($flag)){
            return $this->fail(50011);
        }

        $re = $creationService->changeChoice($creationId);

        if (!empty($re)) {
            return $this->success();
        } else {
            return $this->fail(300);
        }
    }


}