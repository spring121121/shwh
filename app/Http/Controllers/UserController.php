<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use App\Http\Services\UserService;
use App\models\StoreModel;
use Illuminate\Http\Request;
use App\models\UserModel;
use Validator;

class UserController extends BaseController
{
    /**
     * 用户信息修改
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserInfo(Request $request)
    {
        $userModel = new UserModel();
        $this->validate($request, [
            'nickname' => 'required|string',
            'sex' => 'required|between:0,1',
            'birthday' => 'required|date',

        ]);
        $uid = UserService::getUid($request);
        $nickname = $request->input('nickname');
        $sex = $request->input('sex');
        $birthday = $request->input('birthday');
        $photo = $request->input('photo');

        $updateArr = [
            'nickname' => $nickname,
            'sex' => $sex,
            'birthday' => $birthday,
            'photo' => $photo,

        ];
        $result = $userModel::where('id', $uid)->update($updateArr);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail();
        }
    }

    //修改头像
    public function updatePhoto(Request $request){
        $data = [];
        $photo = $request->input('photo');
        $rules = [
            'photo' => 'required'
        ];
        $data['photo'] = $photo;
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $uid = UserService::getUid($request);
        $result = UserModel::where('id', $uid)->update($data);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 根据用户id查询用户信息
     * @param $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo(Request $request, $id)
    {
        $result = UserService::getUserInfoByUid($request, $id);

        return $this->success($result);
    }

    /**
     * 获取我的用户信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyUserInfo(Request $request)
    {
        $id = UserService::getUid($request);
        $userModel = new UserModel();
        $result = $userModel::find($id);
        $result->grade = UserService::getGrade($result->score);
        $store_status = StoreModel::where('uid', $id)->select('status', 'id')->first();
        if ($store_status) {
            $result->store_status = $store_status->toArray()['status'];
            $result->store_id = $store_status->toArray()['id'];
        } else {
            $result->store_id = StoreModel::STORE_ID;
            $result->store_status = StoreModel::STORE_STATUS;
        }
        return $this->success($result);
    }
}