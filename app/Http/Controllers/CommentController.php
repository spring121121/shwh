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

    public function noteReply(Request $request)
    {
        $data['note_id'] = $request->input('note_id');
        $data['content'] = $request->input('content');
        if(!check_post($data)) {
            return $this->fail(70000,$data);
        }
        $data['to_cid'] = $request->input('to_cid',0);
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
        $comment->type = 1;

        $info['to_nickname'] = '';
        if($to_cid) {
            $comment_exist = $comment
                ->leftJoin('user', 'comment.to_uid', '=', 'user.id')
                ->where('comment.id',$to_cid)
                ->select('comment.*,user.nickname AS to_nickname')
                ->first();
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
            $info['to_nickname'] = $comment_exist->to_nickname;
        }else {
            $comment->root_cid = 0;
        }
        $comment->note_id = $note_id;
        $comment->content = $content;
        try {
            $comment->save();
            $info['id'] = $comment->id;
        }catch (\Exception $e) {
            return $this->fail(300,$e->getMessage());
        }
        $info['photo'] = $userinfo['photo'];
        $info['nickname'] = $userinfo['nickname'];
        $info['content'] = $data['content'];
        $info['created_at'] = date('Y-m-d H:i:s');
        return $this->success($info);

    }

    public function activeReply(Request $request)
    {
        $data['note_id'] = $request->input('note_id');
        $data['content'] = $request->input('content');
        if(!check_post($data)) {
            return $this->fail(70000,$data);
        }
        $data['to_cid'] = $request->input('to_cid',0);
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
        $comment->type = 2;
        $info['to_nickname']= '';
        if($to_cid) {
            try {
                $comment_exist = $comment
                    ->leftJoin('user', 'comment.uid', '=', 'user.id')
                    ->where('comment.id',$to_cid)
                    ->select('comment.*','user.nickname')
                    ->first();
            }catch (\Exception $e) {
                return $this->success($e->getMessage());

            }
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
            $info['to_nickname'] = $comment_exist->nickname;
        }else {
            $comment->root_cid = 0;
        }
        $comment->note_id = $note_id;
        $comment->content = $content;
        try {
            $comment->save();
            $info['id'] = $comment->id;
        }catch (\Exception $e) {
            return $this->fail(300,$e->getMessage());
        }
        $info['photo'] = $userinfo['photo'];
        $info['nickname'] = $userinfo['nickname'];
        $info['content'] = $data['content'];
        $info['created_at'] = date('Y-m-d H:i:s');
        $info['root_cid'] = $comment->root_cid;
        return $this->success($info);

    }

    public function getNoteCommentList(Request $request) {
        $noteId = $request->input('note_id','');
        $list = [];
        try {
            DB::setFetchMode(PDO::FETCH_ASSOC);
            $list = DB::select("SELECT c.id,c.note_id,c.uid,c.to_cid,c.to_uid,c.content,c.root_cid,c.created_at,u.photo,u.nickname,u2.nickname AS to_nickname 
FROM comment c 
LEFT JOIN user u ON c.uid=u.id 
LEFT JOIN user u2 ON c.to_uid=u2.id 
WHERE c.note_id=?",[$noteId]);
        }catch (\Exception $e) {
            exit($e->getMessage());
        }
        $list = $this->recursion($list);
        return $this->success($list);
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


    private function recursion($array,$to_cid=0) {
        $to_array = [];
        foreach ($array as $v) {
            if($v['root_cid'] == $to_cid) {
                $v['child'] = $this->recursion($array,$v['id']);
                $to_array[] = $v;
            }
        }
        return $to_array;
    }
//DB_CONNECTION=mysql
//DB_HOST=106.13.11.79
//DB_PORT=3306
//DB_DATABASE=cave
//DB_USERNAME=root
//DB_PASSWORD=smm2018@

}