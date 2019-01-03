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
use App\models\FocusModel;
use App\models\CollectModel;
use App\models\LikesModel;
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
            $rules = [
                'title' => 'required|string|min:1|max:200',
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

    }

    /**
     * 系统消息列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSysMessage(Request $request){
        $uid = $request->session()->get('userInfo')['id'];
        $messageList = SysmessageModel::where('sys_message.receive_user_id',$uid)
            ->join('user','sys_message.pub_user_id','=','user.id')
            ->select('sys_message.*', 'user.photo')
            ->get()->toArray();
        $readCount = SysmessageModel::where(['receive_user_id'=>$uid,'is_read'=>0])
            ->count();
        $messageList['is_read_count'] = $readCount;
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
            $result = DismessageModel::create($data);
            if ($result) {
                return $this->success();
            } else {
                return $this->fail('300');
            }
        }
    }

    /**
     * 笔记评论列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommentMessage(Request $request){
        $uid = $request->session()->get('userInfo')['id'];
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

    /**
     * 我的粉丝数量，被关注的用户数量
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myFans(Request $request){
        $uid = $request->session()->get('userInfo')['id'];
        $fanCount = FocusModel::where('uid',$uid)
           ->count();
        return $this->success($fanCount);
    }

    /**
     * 我关注的用户数量
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myFocus(Request $request){
        $uid = $request->session()->get('userInfo')['id'];
        $focus = FocusModel::where('focus.beuid',$uid)
            ->join('user','focus.uid','=','user.id')
            ->select('user.photo','user.nickname','note.title','note.content as note_content','note.image_one_url')
            ->get()->toArray();
        return $this->success($focus);
    }

    /**
     * 我的收藏列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myCollect(Request $request){
        $uid = $request->session()->get('userInfo')['id'];
        $collectList = CollectModel::where('collect.uid',$uid)
            ->join('note','collect.note_id','=','note.id')
            ->join('user','collect.uid','=','user.id')
            ->select('user.photo','user.nickname','note.title','note.content as note_content','note.image_one_url')
            ->get()->toArray();
        return $this->success($collectList);
    }

    /**
     * 我获赞的数量
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myPraise(Request $request){
        $uid = $request->session()->get('userInfo')['id'];
        $noteId = $request->input('noteid');
        $praiseCount = LikesModel::where(['uid'=>$uid,'note_id'=>$noteId])
            ->count();
        return $this->success($praiseCount);
    }
}