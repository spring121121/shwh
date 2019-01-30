<?php

namespace App\Http\Services;

use App\models\CreationModel;
use Illuminate\Support\Facades\DB;

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
    public function getCreationList($uid = '', $searchContent = '', $page = 1, $take = 10)
    {
        $skip = ($page - 1) * $take;

        $sql = DB::table('creation')->join("user","user.id","=","creation.uid");

        if (!empty($uid)) {//查询某个用户的需求列表
            $sql = $sql->where('creation.uid', '=', $uid);
        }

        if (!empty($searchContent)) {
            $sql = $sql->where('introduction', 'like', $searchContent . "%");
        }

        $creationList = $sql->select("creation.*", "user.photo")->skip($skip)->take($take)->get();

        return $creationList;
    }

    /**
     * 获取一个作品的详情
     * @param $creationId
     * @return mixed
     */
    public function getCreationDetail($creationId){
        $creationModel = new CreationModel();
        $creationInfo = $creationModel->join('user', 'user.id', '=', 'creation.uid')
            ->select("creation.*", "user.photo")->find($creationId);

        return $creationInfo;
    }

    /**
     * 获取某个需求的获奖作品
     * @param $demandId
     * @return mixed
     */
    public function getChoiceCreationList($demandId){
        $creationModel = new CreationModel();
        $creationInfo = $creationModel::where('demand_id',$demandId)->where('is_choice',CreationModel::IS_CHOICE_1)->get();

        return $creationInfo;
    }


}

