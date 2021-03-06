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
use App\Http\Services\ValidateCodeService;

class StoreController extends BaseController
{
    /**
     * 新增店铺
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addStore(Request $request)
    {

        $data = $request->input('store');
        //1.校验各个参数
        $rules = [
            'name' => 'required|string|min:1|max:20',
            'introduction' => 'required|string|min:1|max:200',
            'logo_pic_url' => 'required',
            'real_name' => 'required',
            'id_card_num' => 'required',
            'id_card_front' => 'required',
            'id_card_backend' => 'required',
        ];
        $validator = Validator::make($data, $rules, config('message.store'));

        if ($validator->fails()) {
            return $this->fail(50001, '', $validator->errors()->all()[0]);
        }

        //2.检测该用户是不是已经有一个店铺
        $uid = UserService::getUid($request);
        $count = StoreModel::where('uid', $uid)->count();
        if ($count != 0) {
            return $this->fail(60001);//已经存在店铺
        }

        $data['uid'] = $uid;
        $data['status'] = StoreModel::IS_NOT_AUTH;
        $result = StoreModel::create($data);
        //4.修改用户表里该用户的角色
        $userData['role'] = $data['role_id'];
        UserModel::where('id','=',$uid)->update($userData);

        if ($result) {
            return $this->success();
        } else {
            return $this->fail(300);
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
        $uid = UserService::getUid($request);
        $rules = [
            'name' => 'required|max:20',
            'introduction' => 'required|max:200',
            'logo_pic_url' => 'required',
        ];
        $validator = Validator::make($data, $rules, config('message.store'));
        if ($validator->fails()) {
            return $this->fail(50001, $validator->errors()->all());
        }
        $data['status'] = StoreModel::STORE_ID;
        $storeUpdate = StoreModel::where('uid', $uid)->update($data);
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
        if (!$role) {
            return $this->fail(60000);
        }
        $id = $request->input('id');
        $status = $request->input('is_auth');
        $feedbackUpdate = StoreModel::where('id', $id)
            ->update(['status' => $status, 'auth_id' => $uid]);
        if ($feedbackUpdate) {
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
     * 我的店铺详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myStoreDetail(Request $request)
    {
        $uid = UserService::getUid($request);
        $myStoreList = StoreModel::where('store.uid', $uid)
            ->join('user','store.uid','=','user.id')
            ->select('user.role','store.*')
            ->get()->toArray();
        return $this->success($myStoreList);
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
        $keyword = $request->input('storeName', null);
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $offset = ($page-1)*$limit;
        $sql= UserModel::where('role', '=', $roleId)->where('store.status', '=', StoreModel::IS_AUTH);
        if (!empty($keyword)) {
            $sql = $sql->where('store.name', 'like', '%' . $keyword . '%');

        }
        $storeList = $sql->join('store', 'store.uid', '=', 'user.id')
            ->select('store.id', 'store.name', 'store.introduction', 'store.logo_pic_url', 'user.photo','user.nickname', 'store.uid')
            ->orderBy('commend_level','desc')
            ->skip($offset)->take($limit)->get();
        return $this->success($storeList);
    }

    /**
     * 微信用户申请店铺时需要先绑定手机号
     * @param Request $request
     * @param $openId
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindMobile(Request $request, $openId)
    {
        //1.校验各个必填参数是不是都传了
        $rules = [
            'mobile' => 'required|unique:user,mobile',
            'password' => 'required',
            'code' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules, config('message.user'));
        if ($validator->fails()) {
            return $this->fail(50001, '', $validator->errors()->all()[0]);
        }

        //2.校验验证码是否正确
        $code = $request->input('code');
        $isRight = ValidateCodeService::checkValidate($request, $code);

        if (!$isRight) {
            return $this->fail(50000);
        }

        //3.更新用户表的密码和手机号字段
        $updateArr = [
            'mobile' => $request->input("mobile"),
            'password' => md5($request->input("mobile"))
        ];
        $userModel = new UserModel();
        $re = $userModel::where('openid', '=', $openId)->update($updateArr);
        if ($re != 0) {
            return $this->success();
        } else {
            return $this->fail(300);
        }

    }

}