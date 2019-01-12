<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;

use App\models\UserModel;
use Illuminate\Http\Request;
use App\models\StoreModel;
use App\Http\Services\UserService;
use Validator;

class StoreController extends BaseController
{
    /**
     * 新增店铺
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addStore(Request $request)
    {
        $uid = UserService::getUid($request);
        $data = $request->input('store');
        $data['uid'] = $uid;
        $count = StoreModel::where('uid',$uid)
            ->count();
        if($count != 0){
            return $this->fail(60001);//已经存在店铺
        }
        $rules = [
            'name' => 'required|string|min:1|max:20',
            'introduction' => 'required|string|min:1|max:200',
            'logo_pic_url' => 'required',
            'prove_url' => 'required',
        ];
        $validator = Validator::make($data, $rules,config('message.store'));
        if ($validator->fails()) {
            return $this->fail(50001, $validator->errors()->all());
        }
        $result = StoreModel::create($data);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 修改店铺
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStore(Request $request)
    {
        $data = $request->input('store');
        $rules = [
            'name' => 'required|string|min:1|max:20',
            'introduction' => 'required|string|min:1|max:200',
        ];
        $validator = Validator::make($data, $rules,config('message.store'));
        if ($validator->fails()) {
            return $this->fail(50001, $validator->errors()->all());
        }
        $storeUpdate = StoreModel::where('id', $data['id'])->update($data);
        if ($storeUpdate) {
            return $this->success();
        } else {
            return $this->fail(300);
        }
    }

    /**
     * 认证店铺
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authStore(Request $request)
    {
        $uid = UserService::getUid($request);
        $role = UserService::getUserRight($request);
        if(!$role){
            return $this->fail(60000);
        }
        $id = $request->input('id');
        $status = $request->input('is_auth');
        $feedbackUpdate = StoreModel::where('id',$id)
            ->update(['status'=>$status,'auth_id'=>$uid]);
        if($feedbackUpdate){
            return $this->success();
        } else {
            return $this->fail(300);
        }
    }

    /**
     * 店铺列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeList()
    {
        $storeList = StoreModel::select('name', 'uid', 'introduction', 'logo_pic_url', 'prove_url', 'auth_id')
            ->get()->toArray();
        return $this->success($storeList);
    }

    /**
     * 店铺详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeDetail(Request $request)
    {
        $uid = UserService::getUid($request);
        $feedbackList = StoreModel::where('uid', $uid)
            ->select('name', 'uid', 'introduction', 'logo_pic_url', 'prove_url', 'auth_id')
            ->get()->toArray();
        return $this->success($feedbackList);
    }

    /**
     * 上传认证图
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadAuth(Request $request)
    {
        $id = $request->input('id');
        $prove_url = $request->input('prove_url');
        $proveUpdate = StoreModel::where('id', $id)
            ->update(['prove_url' => $prove_url]);
        if ($proveUpdate) {
            return $this->success();
        } else {
            return $this->fail(300);
        }
    }

    /**
     * 获取相应角色的店铺
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStoreListBySearch(Request $request)
    {
        $roleId = $request->input('roleId');
        $keyword = $request->input('storeName',null);
        if(!empty($keyword)){
            $storeList = UserModel::where('role','=',$roleId)->where('store.name','like','%'.$keyword.'%')->where('store.status','=',StoreModel::IS_AUTH)->join('store','store.uid','=','user.id')
                ->select('store.name','store.introduction','logo_pic_url')->get();
        }else{
            $storeList = UserModel::where('role','=',$roleId)->where('store.status','=',StoreModel::IS_AUTH)->join('store','store.uid','=','user.id')
                ->select('store.name','store.introduction','logo_pic_url')->get();
        }
        return $this->success($storeList);
    }

}