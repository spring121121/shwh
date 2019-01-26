<?php

namespace App\Http\Services;

use App\models\DemandModel;

class DemandService
{
    /**
     * 获取需求列表
     * @param string $uid
     * @param string $searchContent
     * @param string $skip
     * @param string $take
     * @return mixed
     */
    public function getDemandList($uid = '', $searchContent = '',$skip='0',$take='1')
    {
        $demandModel = new DemandModel();
        $date = date("Y-m-d H:i:s");

        $sql = $demandModel::where('end_time', '>', $date)
            ->join('user', 'user.id', '=', 'demand.uid');
        if (!empty($uid)) {//查询所有的需求列表

            $sql = $sql->where('uid', '=', $uid);
        }

        if (!empty($searchContent)) {
            $sql = $sql->where('title', 'like', $searchContent . "%");
        }

        $demandList = $sql->select("demand.*","user.photo")->skip($skip)->take($take)->get()->toArray();

        return $demandList;
    }

    /**
     * 获取需求详情
     * @param $demandId
     * @return mixed
     */
    public function getDemandDetail($demandId)
    {
        $demandModel = new DemandModel();
        $demandDetail = $demandModel->join('user', 'user.id', '=', 'demand.uid')
            ->select("demand.*","user.photo")
            ->find($demandId);

        return $demandDetail;
    }
}

