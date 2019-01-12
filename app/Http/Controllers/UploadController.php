<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Storage;
use zgldh\QiniuStorage\QiniuStorage;

class UploadController extends BaseController
{

    /**
     * 文件上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        if ($request->isMethod('POST')) { //判断是否是POST上传，应该不会有人用get吧，恩，不会的

            //在源生的php代码中是使用$_FILE来查看上传文件的属性
            //但是在laravel里面有更好的封装好的方法，就是下面这个
            //显示的属性更多
            $fileCharater = $request->file('source');
            $url_path = 'uploadimg';
            if ($fileCharater->isValid()) { //括号里面的是必须加的哦
                //如果括号里面的不加上的话，下面的方法也无法调用的

                //获取文件的扩展名
                $ext = $fileCharater->getClientOriginalExtension();

                //获取文件的绝对路径
                //$path = $fileCharater->getRealPath();

                //定义文件名
                $filename = date('Y-m-d-H-i-s') . '.' . $ext;

                $res = $fileCharater->move($url_path, $filename);
                //存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
                //$re = Storage::disk('public')->put($filename, file_get_contents($path));
            }
        }

        if ($res) {
            return $this->success(['url'=>'/uploadimg/'.$filename]);
        }else{
            return $this->fail(300);
        }
    }

    /**
     * 获取七牛上传的token
     * @return mixed
     */
    public function getQiniuUploadToken(){
        $disk = QiniuStorage::disk('qiniu');
        $token = $disk->uploadToken();
        return $token;
    }

}