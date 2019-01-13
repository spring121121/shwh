<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use App\models\LikesModel;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Services\ForwardService;
use App\Http\Services\LikesService;
use App\Http\Services\CommentService;

class LikeController extends BaseController
{
    public function getMyLikeNote(Request $request)
    {
        $uid = UserService::getUid($request);
        $likeModel = new LikesModel();
        $limit = $request->get('limit', 10);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $collectNote = $likeModel::where('likes.uid', '=', $uid)
            ->join('note', 'note.id', '=', 'likes.note_id')
            ->skip($offset)->take($limit)->get();
        foreach ($collectNote as $note) {
            $note->forwardNum = ForwardService::getForwardNum($note->note_id);
            $note->likeNum = LikesService::getLikesNum($note->note_id);
            $note->commentNum = CommentService::getCommentNum($note->note_id);
        }

        if ($collectNote) {
            return $this->success($collectNote);
        } else {
            return $this->fail(300);
        }

    }

    /**
     * 获取他人点赞的笔记
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOtherLikeNote(Request $request,$id)
    {
        $likeModel = new LikesModel();
        $limit = $request->get('limit', 10);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $collectNote = $likeModel::where('likes.uid', '=', $id)
            ->join('note', 'note.id', '=', 'likes.note_id')
            ->skip($offset)->take($limit)->get();
        foreach ($collectNote as $note) {
            $note->forwardNum = ForwardService::getForwardNum($note->note_id);
            $note->likeNum = LikesService::getLikesNum($note->note_id);
            $note->commentNum = CommentService::getCommentNum($note->note_id);
        }

        if ($collectNote) {
            return $this->success($collectNote);
        } else {
            return $this->fail(300);
        }

    }


}