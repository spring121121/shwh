<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use App\Http\Services\UserService;
use Illuminate\Http\Request;
use App\models\UserModel;

class UserController extends BaseController
{
    /**
     * 用户信息添加
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserInfo(Request $request)
    {
        $userModel = new UserModel();
        $this->validate($request, [
            'name' => 'required|string',
            'nickname' => 'required|string',
            'password' => 'required|string',
            'sex' => 'required|between:0,1',
            'role' => 'required|int',
            'birthday' => 'required|date',

        ]);
        $id = $request->input('id');
        $name = $request->input('name');
        $nickname = $request->input('nickname');
        $password = md5($request->input('password'));
        $sex = $request->input('sex');
        $role = $request->input('role');
        $birthday = $request->input('birthday');


        $updateArr = [
            'name' => $name,
            'nickname' => $nickname,
            'password' => $password,
            'sex' => $sex,
            'role' => $role,
            'birthday' => $birthday,

        ];
        $result = $userModel::where('id', $id)->update($updateArr);

        if ($result) {
            return $this->success();
        } else {
            return $this->fail();
        }


    }

    /**
     * 根据用户id查询用户信息
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo($id)
    {
        $userModel = new UserModel();
        $result = $userModel::find($id);
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
        return $this->success($result);
    }


}