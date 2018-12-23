<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */



namespace App\Http\Controllers;



use Illuminate\Http\Request;
class TestController extends BaseController
{
    /**
     * 显示指定用户的个人数据。
     *
     * @param  int  $id
     * @return Response
     */
    public function userAdd()
    {

        //return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    /**
     * e.g 接参 && 校验
     * 接参 文档：https://laravel-china.org/docs/laravel/5.2/requests/1102
     * 校验 文档：https://laravel-china.org/docs/laravel/5.2/validation/1135
     * @param Request $request
     * @param $id
     */
    public function testRequest(Request $request,$id){

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',

        ]);
        echo $id;
    }
    public function testResponse(){

    }

}