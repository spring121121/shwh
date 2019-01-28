<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;
header("Access-Control-Allow-Origin: *");

use App\models\CommentModel;
use App\models\NoteModel;
use Illuminate\Http\Request;
use App\models\UserModel;
use App\Http\Services\ValidateCodeService;
use Illuminate\Support\Facades\DB;
use PDO;
class CommentController extends BaseController
{

    public function reply(Request $request)
    {
        $data['note_id'] = $request->input('note_id');
        $data['content'] = $request->input('content');
        if(!check_post($data)) {
            return $this->fail(70000,$data);
        }
        $data['to_cid'] = $request->input('to_cid');
        $userinfo = $request->session()->get('userInfo');
        if(!$userinfo) {
            return $this->fail(50009);
        }

        $note_id = $data['note_id'];
        $to_cid = $data['to_cid'];
        $content = $data['content'];
        $exist = NoteModel::where('id',$note_id)->first();
        if(!$exist) {
            return $this->fail(70007);
        }
        $comment = new CommentModel();

        $comment->uid = $userinfo['id'];

        if($to_cid) {
            $comment_exist = $comment->where('id',$to_cid)->first();
            if(!$comment_exist) {
                return $this->fail(70008);
            }
            $comment->to_cid = $to_cid;
            $comment->to_uid = $comment_exist->uid;
            if($comment_exist->to_cid == 0) {
                $comment->root_cid = $comment_exist->id;
            }else {
                $comment->root_cid = $comment_exist->root_cid;
            }
        }else {
            $comment->root_cid = 0;
        }
        $comment->note_id = $note_id;
        $comment->content = $content;
        try {
            $comment->save();
        }catch (\Exception $e) {
            return $this->fail(300,$e->getMessage());
        }

        return $this->success();

    }

    public function tt(Request $request) {
        DB::setFetchMode(PDO::FETCH_ASSOC);
        $exist = NoteModel::get();
        $exist = DB::table('user')->get();
        halt($exist);
//        $note_id = 1;
//        $to_cid = 1;
//        $content = '内容啊';
//        $exist = NoteModel::where('id',$note_id)->first();
//        if(!$exist) {
//            return $this->fail(70007);
//        }
//        $comment = new CommentModel();
//
//        if($to_cid) {
//            $comment_exist = $comment->where('id',$to_cid)->first();
//            if(!$comment_exist) {
//                return $this->fail(70008);
//            }
//            $comment->to_cid = $to_cid;
//            $comment->to_uid = $comment_exist->uid;
//        }
//        $comment->note_id = $note_id;
//        $comment->content = $content;
//        try {
//            $comment->save();
//        }catch (\Exception $e) {
//            return $this->fail(300,$e->getMessage());
//        }
//        halt('ITS OKOK!');
    }


}