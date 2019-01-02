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
use Validator;
class InformationController extends BaseController
{
    /**
     * 管理员发布系统消息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pubSysMessage(Request $request){
        if($request->method('POST')){
            $data = $request->input('message');
            //var_dump($data);
            $rules = [
                'title' => 'required|string|min:1|max:200',
                'content' => 'required|string|min:1|max:200'
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                return $this->fail(50001,$validator->errors()->all());
            }
            $messageModel = new SysmessageModel($data);
            $result = $messageModel->save();
            if ($result) {
                return $this->success();
            } else {
                return $this->fail();
            }
        }

    }

    /**
     * 系统消息列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSysMessage(Request $request){
        $uid = $request->input('uid');
        $messageModel = new SysmessageModel();
        $messageList = $messageModel::where('sys_message.receive_user_id',$uid)
            ->join('user','sys_message.pub_user_id','=','user.id')
            ->select('sys_message.*', 'user.photo')
            ->get()->toArray();
        return $this->success($messageList);
    }

    /**
     * 笔记评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function commentNote(Request $request){
        if($request->method('POST')){
            $data = $request->input('comment');
            $rules = [
                'content' => 'required|string|min:1|max:200'
            ];
            $validator = Validator::make($data,$rules);
            if($validator->fails()){
                return $this->fail(50001,$validator->errors()->all());
            }
            $messageModel = new DismessageModel($data);
            $result = $messageModel->save();
            if ($result) {
                return $this->success();
            } else {
                return $this->fail();
            }
        }
    }

    /**
     * 笔记评论列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommentMessage(Request $request){
        $uid = $request->input('uid');
        $noteModel = new NoteModel();
        $messageList = $noteModel::where('note.uid',$uid)
            ->join('dis_message','note.id','=','dis_message.note_id')
            ->join('user','note.uid','=','user.id')
            ->select('dis_message.*','user.photo','user.nickname','note.title','note.content as note_content','note.image_one_url')
            ->get()->toArray();
        return $this->success($messageList);
    }

}