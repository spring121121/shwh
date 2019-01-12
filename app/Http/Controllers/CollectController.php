<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\models\CollectModel;
use App\Http\Services\UserService;
use App\Http\Services\ForwardService;
use App\Http\Services\LikesService;
use App\Http\Services\CommentService;

class CollectController extends BaseController
{
    public function getMyCollectNote(Request $request)
    {
        $uid = UserService::getUid($request);
        $collectModel = new CollectModel();
        $limit = $request->get('limit', 10);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $collectNote = $collectModel::where('collect.uid', '=', $uid)
            ->join('note', 'note.id', '=', 'collect.note_id')
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
     * 获取某个用户收藏的笔记
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOtherCollectNote(Request $request,$id)
    {

        $collectModel = new CollectModel();
        $limit = $request->get('limit', 10);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $collectNote = $collectModel::where('collect.uid', '=', $id)
            ->join('note', 'note.id', '=', 'collect.note_id')
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