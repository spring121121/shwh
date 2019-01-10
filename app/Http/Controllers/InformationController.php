<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;

use App\models\SysmessageModel;
use Illuminate\Http\Request;
use App\models\DismessageModel;
use App\models\NoteModel;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Validator;
//use Validator;
class InformationController extends BaseController
{
    /**
     * 管理员发布系统消息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pubSysMessage(Request $request){
        $data = $request->input('message');
        $role = UserService::getUserRight($request);
        if(!$role){
            return $this->fail(60000);
        }
        $rules = [
            'title' => 'required|string|min:1|max:20',
            'content' => 'required|string|min:1|max:200'
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $result = SysmessageModel::create($data);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 系统消息列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSysMessage(Request $request){
        $uid = UserService::getUid($request);
        $list = [];
        $messageList = SysmessageModel::where('sys_message.receive_user_id',$uid)
            ->join('user','sys_message.pub_user_id','=','user.id')
            ->select('sys_message.*', 'user.photo')
            ->get()->toArray();
        $readCount = SysmessageModel::where(['receive_user_id'=>$uid,'is_read'=>0])
            ->count();
        $list['data'] = $messageList;
        $list['is_read_count'] = $readCount;
        return $this->success($list);
    }

    /**
     * 笔记评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function commentNote(Request $request){
        $data = $request->input('comment');
        $rules = [
            'content' => 'required|string|min:1|max:200'
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $result = DismessageModel::create($data);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 笔记评论列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommentMessage(Request $request){
        $uid = UserService::getUid($request);
        $messageList = NoteModel::where('note.uid',$uid)
            ->join('dis_message','note.id','=','dis_message.note_id')
            ->join('user','note.uid','=','user.id')
            ->select('dis_message.*','user.photo','user.nickname','note.title','note.content as note_content','note.image_one_url')
            ->get()->toArray();
        return $this->success($messageList);
    }

    /**
     * 已读系统消息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function readSysMessage(Request $request){
        $id = $request->input('id');
        $messageUpdate = SysmessageModel::where('id',$id)
            ->update(['is_read'=>SysmessageModel::IS_READ]);
        if($messageUpdate){
            return $this->success();
        }else{
            return $this->fail(300);
        }
    }
}