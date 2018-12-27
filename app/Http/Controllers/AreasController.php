<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use App\models\ProvinceModel;
use App\models\CityModel;
use App\models\AreasModel;


class AreasController extends BaseController
{

    /**
     * 获取所有省的接口
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProvinces()
    {
        $provinceModel = new ProvinceModel();
        $province = $provinceModel->get();
        return $this->success($province);
    }

    /**
     * 获取相应省下面对应的城市列表
     * @param $provinceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCitiesByProvince($provinceId)
    {
        $cityModel = new CityModel();
        $cities = $cityModel::where("provinceid", $provinceId)->get();
        return $this->success($cities);
    }

    /**
     * 根据城市id
     * @param $cityId获取该城市下所有的区
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAreasByCityId($cityId)
    {
        $areasModel = new AreasModel();
        $areas = $areasModel::where("cityid", $cityId)->get();
        return $this->success($areas);
    }


}