<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


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
    public function addressList(Request $request){

        $addressModel = new AddressModel();
        $uid = $request->session()->get('userInfo')['id'];
        $addressList = $addressModel::where('uid',$uid)
            ->join('provinces','address.province','=','provinces.provinceid')
            ->join('cities','address.city','=','cities.cityid')
            ->join('areas','address.area','=','areas.areaid')
            ->get()->toArray();

        return $this->success($addressList);

    }

    /**
     * 添加收货地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAddress(Request $request){
        $rules = [
            'province' => 'required',
            'city' => 'required',
            'area' => 'required',
            'address_info' => 'required',
            'mobile' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }

        $uid = $request->session()->get('userInfo')['id'];
        $addressInfo = $request->input('address_info');
        $province = $request->input('province');
        $city = $request->input('city');
        $area= $request->input('area');
        $mobile = $request->input('mobile');
        $addressModel = new AddressModel();
        $addressModel->uid = $uid;
        $addressModel->province = $province;
        $addressModel->city = $city;
        $addressModel->area = $area;
        $addressModel->address_info = $addressInfo;
        $addressModel->mobile = $mobile;
        $re = $addressModel->save();

        if($re){
            return $this->success();
        }else{
            return $this->fail(300);
        }
    }

    /**
     * 更新收货地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAddress(Request $request){
        $rules = [
            'id'=>'required',
            'province' => 'required',
            'city' => 'required',
            'area' => 'required',
            'address_info' => 'required',
            'mobile' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }

        $uid = $request->session()->get('userInfo')['id'];
//        $uid = 1;
        $id = $request->input('id');
        $addressInfo = $request->input('address_info');
        $province = $request->input('province');
        $city = $request->input('city');
        $area= $request->input('area');
        $mobile = $request->input('mobile');


        $updateArr = [
            'province'=>$province,
            'city'=>$city,
            'area'=>$area,
            'address_info'=>$addressInfo,
            'mobile'=>$mobile
            ];
        $addressModel = new AddressModel();

        $re = $addressModel::where('id','=',$id)
            ->where('uid','=',$uid)
            ->update($updateArr);

        if($re){
            return $this->success();
        }else{
            return $this->fail(300);
        }
    }



}