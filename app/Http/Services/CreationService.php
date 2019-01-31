<?php

namespace App\Http\Services;

use App\models\CreationModel;
use App\models\DemandModel;
use Illuminate\Support\Facades\DB;
use App\models\FocusModel;
use App\Http\Services\FocusService;

class CreationService
{

    /**
     * 获取作品列表
     * @param string $uid
     * @param string $searchContent
     * @param int $page
     * @param int $take
     * @return mixed
     */
    public function getCreationList($request, $uid = '', $searchContent = '', $page = 1, $take = 10)
    {
        $skip = ($page - 1) * $take;

        $sql = DB::table('creation')->join("user", "user.id", "=", "creation.uid")
            ->join('focus', 'focus.beuid', '=', 'creation.uid');

        if (!empty($uid)) {//查询某个用户的需求列表
            $sql = $sql->where('creation.uid', '=', $uid);
        }

        if (!empty($searchContent)) {
            $sql = $sql->where('introduction', 'like', $searchContent . "%");
        }

        $creationList = $sql->select("creation.*", "user.photo", "user.nickname", DB::raw('count(focus.id) as num'))
            ->groupBy("focus.beuid")->orderBy('num', 'desc')->skip($skip)->take($take)->get();


        $loginUid = UserService::getUid($request);
        $focusService = new FocusService();
        foreach ($creationList as $info) {
            $info->is_focus = $focusService->judgeIsFocus($loginUid, $info->uid);
        }


        return $creationList;
    }

    /**
     * 获取一个作品的详情
     * @param $creationId
     * @return mixed
     */
    public function getCreationDetail($creationId)
    {
        $creationModel = new CreationModel();
        $creationInfo = $creationModel->join('user', 'user.id', '=', 'creation.uid')
            ->select("creation.*", "user.photo", "user.nickname")->find($creationId);

        return $creationInfo;
    }

    /**
     * 获取某个需求的获奖作品
     * @param $demandId
     * @return mixed
     */
    public function getChoiceCreationList($demandId)
    {
        $creationModel = new CreationModel();
        $creationInfo = $creationModel::where('demand_id', $demandId)
            ->where('is_choice', CreationModel::IS_CHOICE_1)
            ->join("user", "user.id", "=", "creation.uid")
            ->select("creation.*", "user.photo", "user.nickname")->get();

        return $creationInfo;
    }

    /**
     * 获取某个需求的作品
     * @param $request
     * @param $demandId
     * @return mixed
     */
    public function getDemandCreationList($request,$demandId)
    {
        $creationModel = new CreationModel();
        $creationList = $creationModel::where('demand_id', $demandId)->join("user", "user.id", "=", "creation.uid")
            ->select("creation.*", "user.photo", "user.nickname")->get();
        $focusService = new FocusService();
        $loginUid = UserService::getUid($request);
        foreach ($creationList as $info) {
            $info->is_focus = $focusService->judgeIsFocus($loginUid, $info->uid);
        }
        return $creationList;
    }

    /**
     * 判断当前登录用户和需求的发表人uid是否一致
     * @param $loginUid
     * @param $demandId
     * @return bool
     */
    public function judgeLoginIsDemandUid($loginUid,$demandId){
         $demandInfo = DemandModel::find($demandId);
         $uid = $demandInfo->uid;
         if($loginUid == $uid){
             return true;
         }else{
             return false;
         }
    }

    /**
     * 切换入围还是不入围
     * @param $creationId
     * @return mixed
     */
    public function changeChoice($creationId){
        $info = CreationModel::find($creationId);
        if($info['is_choice']==CreationModel::IS_CHOICE_1){
            $updateArr['is_choice'] =  CreationModel::IS_CHOICE_0;
        }else{
            $updateArr['is_choice'] =  CreationModel::IS_CHOICE_1;
        }

        $re = CreationModel::where("id",$creationId)->update($updateArr);

        return $re;
    }


}

