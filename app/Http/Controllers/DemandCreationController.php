<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 19-1-25
 * Time: 下午1:24
 */
namespace App\Http\Controllers;

use App\models\DemandCreationModel;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Validator;
class DemandCreationController extends BaseController
{

    /**
     * 参与需求的竞标上传我的作品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addDemandCreation(Request $request)
    {
        $uid = UserService::getUid($request);
        $rules = [
            'creation_urls'=>'required',
            'demand_id'=>'required',
            'introduction'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules,config('message.demandCreation'));
        if ($validator->fails()) {
            return $this->fail(50001, '', $validator->errors()->all()[0]);
        }


        $dataAll = $request->all();

        $demandCreationModel = new DemandCreationModel();
        $demandCreationModel->uid = $uid;
        $demandCreationModel->creation_urls=$dataAll['creation_urls'];
        $demandCreationModel->demand_id=$dataAll['demand_id'];
        $demandCreationModel->introduction=$dataAll['introduction'];

        $re = $demandCreationModel->save();
        if($re){
            return $this->success();
        }else{
            return $this->fail(300);
        }


    }


}