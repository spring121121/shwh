<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;

use App\models\withdrawModel;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Validator;
//use Validator;
class CashController extends BaseController
{
    /**
     * 申请提现
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyCash(Request $request){
        $data = [];
        $apply = $request->input('apply');
        $rules = [
            'apply' => 'required|numeric',
        ];
        $validator = Validator::make(['apply'=>$apply],$rules,config('message.withdraw_cash'));
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $userInfo = $request->session()->get('userInfo');
        $data['apply'] = $apply;
        $data['uid'] = $userInfo['uid'];
        $data['balance'] = $userInfo['wallet'];
        $result = withdrawModel::create($data);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 审核提现申请
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkApply(Request $request){
        $uid = UserService::getUid($request);
        $id = $request->input('id');
        $status = $request->input('status');
        $role = UserService::getUserRight($request);
        if(!$role){
            return $this->fail(60000);
        }
        $checkUpdate = withdrawModel::where('id',$id)
            ->update(['status'=>$status,'check_uid'=>$uid]);
        if($checkUpdate){
            return $this->success();
        }else{
            return $this->fail(300);
        }
    }

}