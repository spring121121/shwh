<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\models\UserModel;

class TestController extends BaseController
{

    /**
     * 显示指定用户的个人数据。
     *
     * @param  int $id
     * @return Response
     */
    public function userAdd()
    {


    $userModel = new UserModel();
    $userModel->name = "smm2";
    $userModel->save();
        //return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    /**
     * e.g 接参 && 校验
     * 接参 文档：https://laravel-china.org/docs/laravel/5.2/requests/1102
     * 校验 文档：https://laravel-china.org/docs/laravel/5.2/validation/1135
     * @param Request $request
     * @param $id
     */
    public function testRequest(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',

        ]);
        echo $id;
    }

    /**
     * e.g HTTP  JSON 响应
     * 文档：https://laravel-china.org/docs/laravel/5.2/responses/1103
     */
    public function testResponse(Request $request)
    {

        $data = [];//data 是返回的内容 格式为数组
        return $this->success($data);
        //默认的错误编码的内容在config/errorcode.php中
        //调用fail方法默认不用带第三个参数，会自动去errorcode.php文件去解析响应code码的含义
        //传了第三个参数直接返回msg信息
        return $this->fail(300, $data);
        return $this->fail(300, $data, $msg = '');
    }

}