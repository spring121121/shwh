<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\FeedbackModel;
use App\models\SysmessageModel;
use App\Http\Services\UserService;
use Validator;
class FeedbackController extends BaseController
{
    /**
     * 意见反馈
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function feedback(Request $request){
        //$uid = $request->session()->get('userInfo')['id'];
        $uid = UserService::getUid($request);
        $feedback = $request->input('feedback');
        $data['feedback'] = $feedback;
        $data['uid'] = $uid;
        $rules = [
            'feedback' => 'required|string|min:1|max:200'
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $result = FeedbackModel::create($data);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 意见反馈已读接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function readFeedback(Request $request){
        //$uid = $request->session()->get('userInfo')['id'];
        $uid = UserService::getUid($request);
        $id = $request->input('id');
        $feedbackUpdate = FeedbackModel::where('id',$id)
            ->update(['status'=>SysmessageModel::IS_READ,'read_user_id'=>$uid]);
        if($feedbackUpdate){
            return $this->success();
        }else{
            return $this->fail(300);
        }
    }

    /**
     * 意见反馈列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function feedbackList(){
        $feedbackList = FeedbackModel::select('id','uid','feedback','status','read_user_id','created_at')
            ->get()->toArray();
        return $this->success($feedbackList);
    }

    /**
     * 意见反馈详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function feedbackDetail(Request $request){
        $id = $request->input('id');
        $feedbackList = FeedbackModel::where('id',$id)
            ->select('id','uid','feedback','status','read_user_id','created_at')
            ->get()->toArray();
        return $this->success($feedbackList);
    }
}