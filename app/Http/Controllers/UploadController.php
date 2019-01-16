<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use App\Http\Services\AipService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Storage;
use zgldh\QiniuStorage\QiniuStorage;
use App\Http\Services\AipImageSearchService;

class UploadController extends BaseController
{

    /**
     * 文件上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        //如果需要检测是否存在相同图就多传一个参数need_check

        $need_check = $request->input("need_check");
        if ($need_check == 1) {
            $aipImageSearchService = new AipImageSearchService();
            $imageContent = file_get_contents($request->file('source')->getPathname());
            $time = time();
            $name = UserService::getUid($request).$time;
            $re = $aipImageSearchService->sameHqSearch($imageContent);
            if($re['result_num']!=0){
                return $this->fail(50008);
            }else{
                //把该图片加入百度相同图片库中
                $aipImageSearchService->sameHqAdd($imageContent,$name,$time);
            }
        }

        //在源生的php代码中是使用$_FILE来查看上传文件的属性
        //但是在laravel里面有更好的封装好的方法，就是下面这个显示的属性更多
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


        if ($res) {
            return $this->success(['url' => '/uploadimg/' . $filename]);
        } else {
            return $this->fail(300);
        }
    }


    /**
     * 获取七牛上传的token
     * @return mixed
     */
    public function getQiniuUploadToken()
    {
        $disk = QiniuStorage::disk('qiniu');
        $token = $disk->uploadToken();
        return $token;
    }

}