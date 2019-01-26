<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use App\Http\Services\AddressService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use App\models\AddressModel;
use Validator;

class AddressController extends BaseController
{
    /**
     * 获取当前登录用户的收货地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addressList(Request $request)
    {

        $addressModel = new AddressModel();
        $uid = UserService::getUid($request);
        $addressList = $addressModel::where('uid', $uid)->get()->toArray();

        return $this->success($addressList);

    }

    /**
     * 默认地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function defaultAddress(Request $request){
        $uid = UserService::getUid($request);
        $id = $request->input('id');
        if(!empty($id)){
            $where = ['id'=>$id,'uid'=>$uid];
            $res = AddressModel::where($where)
                ->first();
        }else{
            $where = ['uid'=>$uid,'is_default'=>AddressModel::IS_DEFAULT_1];
            $res = AddressModel::where($where)
                ->first();
        }
        if(!$res){
            $resFirst = AddressModel::where('uid',$uid)
                ->first();
            if($resFirst){
                $defaultAddress = $resFirst->toArray();
            }else{
                $defaultAddress = [];
            }
        }else{
            $defaultAddress = $res->toArray();
        }
        return $this->success($defaultAddress);
    }

    /**
     * 添加收货地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAddress(Request $request)
    {
        $rules = [
            'name' => 'required',
            'province' => 'required',
            'city' => 'required',
            'area' => 'required',
            'address_info' => 'required',
            'mobile' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->fail(50001, $validator->errors()->all());
        }

        $uid = UserService::getUid($request);
        $addressInfo = $request->input('address_info');
        $province = $request->input('province');
        $name = $request->input('name');
        $city = $request->input('city');
        $area = $request->input('area');
        $mobile = $request->input('mobile');
        $is_default = $request->input('is_default', 0);

        //把其他收货地址都改为非默认
        if($is_default == AddressModel::IS_DEFAULT_1){
            AddressService::updateNotDefault($uid);
        }


        $addressModel = new AddressModel();
        $addressModel->uid = $uid;
        $addressModel->name = $name;
        $addressModel->province = $province;
        $addressModel->city = $city;
        $addressModel->area = $area;
        $addressModel->address_info = $addressInfo;
        $addressModel->mobile = $mobile;
        $addressModel->is_default = $is_default;
        $re = $addressModel->save();

        if ($re) {
            return $this->success();
        } else {
            return $this->fail(300);
        }
    }

    /**
     * 更新收货地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAddress(Request $request)
    {
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'province' => 'required',
            'city' => 'required',
            'area' => 'required',
            'address_info' => 'required',
            'mobile' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->fail(50001, $validator->errors()->all());
        }

        $is_default = $request->input('is_default', 0);

        $uid = UserService::getUid($request);
//        $uid = 1;
        $id = $request->input('id');
        $addressInfo = $request->input('address_info');
        $province = $request->input('province');
        $name = $request->input('name');
        $city = $request->input('city');
        $area = $request->input('area');
        $mobile = $request->input('mobile');

        //把其他收货地址都改为非默认
        if($is_default == AddressModel::IS_DEFAULT_1){
            AddressService::updateNotDefault($uid);
        }

        $updateArr = [
            'province' => $province,
            'name'=>$name,
            'city' => $city,
            'area' => $area,
            'address_info' => $addressInfo,
            'mobile' => $mobile,
            'is_default'=>$is_default
        ];
        $addressModel = new AddressModel();

        $re = $addressModel::where('id', '=', $id)
            ->where('uid', '=', $uid)
            ->update($updateArr);

        if ($re) {
            return $this->success();
        } else {
            return $this->fail(300);
        }
    }

    /**
     * 设置默认地址
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function setDefaultAddress(Request $request, $id)
    {
        //先检测该用户是否已经存在默认地址
        $addressModel = new AddressModel();
        $uid = UserService::getUid($request);
        $update = ['is_default' => AddressModel::IS_DEFAULT_0];
        $addressModel::where('uid', '=', $uid)->update($update);


        $updateArr = ['is_default' => AddressModel::IS_DEFAULT_1];

        $re = $addressModel::where('id', '=', $id)->update($updateArr);
        if ($re) {
            return $this->success();
        } else {
            return $this->fail(300);
        }
    }

    /**
     * 收货地址详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addressDetail(Request $request)
    {
        $id = $request->input('id');
        $addressDetail = AddressModel::where('address.id', $id)
            ->get()->toArray();
        return $this->success($addressDetail);
    }

    /**
     * 删除收货地址
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAddress(Request $request,$id)
    {
        $uid = UserService::getUid($request);
        $re = AddressModel::where('id','=',$id)->where('uid','=',$uid)->delete();
        if($re){
            return $this->success();
        }else{

            return $this->fail(300);
        }

    }

}