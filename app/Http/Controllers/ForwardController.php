<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use App\Http\Services\ForwardService;
use Illuminate\Http\Request;
use App\Http\Services\UserService;

class ForwardController extends BaseController
{
    public function forwardNote(Request $request)
    {
        //1.先检测是否登录了
        $uid = UserService::getUid($request);
        if($uid == 0){
            return $this->fail(50009);
        }
        $forwardService = new ForwardService();
        $noteId = $request->input('note_id');
        $beuid = $request->input('beuid');
        $re = $forwardService->forwardNote($request, $beuid, $noteId);

        if ($re) {
            return $this->success();
        } else {
           return $this->fail();
        }
    }


}