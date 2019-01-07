<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use App\models\GoodsModel;
use App\models\NoteModel;
use Illuminate\Http\Request;
use App\Http\Services\ForwardService;
use App\Http\Services\LikesService;
use App\Http\Services\CommentService;
use App\Http\Services\UserService;


class NoteController extends BaseController
{


    /**
     * add note
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNote(Request $request)
    {
        $uid = UserService::getUid($request);

        $rules = [
            'title' => 'required',
            'content' => 'required',
            'image_one_url' => 'required',
            'image_two_url' => 'required',
            'image_three_url' => 'required',
            'goods_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->fail(50001, $validator->errors()->all());
        }
        $noteModel = new NoteModel();
        $noteModel->uid = $uid;
        $noteModel->title = $request->input('title');
        $noteModel->content = $request->input('content');
        $noteModel->image_one_url = $request->input('image_one_url');
        $noteModel->image_two_url = $request->input('image_two_url');
        $noteModel->image_three_url = $request->input('image_three_url');
        $noteModel->goods_id = $request->input('goods_id');

        if ($noteModel->save()) {
            return $this->success();
        } else {
            return $this->fail(300);
        }


    }

    /**
     * get my NoteList
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyNoteList(Request $request)
    {
        $uid = UserService::getUid($request);
        $noteModel = new NoteModel();
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $offset = ($page - 1) * $limit;
        $noteList = $noteModel::where('uid', '=', $uid)->skip($offset)->take($limit)->get();
        foreach ($noteList as $note) {
            $note->forwardNum = ForwardService::getForwardNum($note->id);
            $note->likeNum = LikesService::getLikesNum($note->id);
            $note->commentNum = CommentService::getCommentNum($note->id);
        }

        //note
        if ($noteList) {
            return $this->success($noteList);
        } else {
            return $this->fail(300);
        }
    }

    /**
     * 删除笔记
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteNote(Request $request)
    {
        $uid = UserService::getUid($request);
        $noteId = $request->get('note_id');
        $noteModel = new NoteModel();
        $re = $noteModel::where('uid', '=', $uid)->find($noteId)->delete();
        if ($re) {
            return $this->success();
        } else {
            return $this->fail(300);
        }
    }

    /**
     * 删除多个笔记
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteNoteNotOnly(Request $request)
    {
        $uid = UserService::getUid($request);
        $noteIds = rtrim($request->get('note_ids'), ',');
        $noteIdArr = explode(',', $noteIds);
//        dd($noteIdArr);
        $noteModel = new NoteModel();
        $re = $noteModel::where('uid', '=', $uid)->whereIn('id', $noteIdArr)->delete();
        if ($re) {
            return $this->success();
        } else {
            return $this->fail(300);
        }
    }

    /**
     * 模糊搜索笔记
     * @param $keyword
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchNote($keyword)
    {
        $noteModel = new NoteModel();
        $noteList = $noteModel::where('title', 'like', '%' . $keyword . '%')->get();
        foreach ($noteList as $note) {
            $note->forwardNum = ForwardService::getForwardNum($note->id);
            $note->likeNum = LikesService::getLikesNum($note->id);
            $note->commentNum = CommentService::getCommentNum($note->id);
        }
        return $this->success($noteList);
    }

    /**
     * 获取某个店铺下相应商品的笔记列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNoteListByStoreId(Request $request)
    {
        $goodsModel = new GoodsModel();
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $storeId = $request->input('store_id');
        $new = $request->input('is_by_new', 0);
        $offset = ($page - 1) * $limit;
        //先根据storeId查询出商品id
        if (!empty($new)) {
            $noteList = $goodsModel::where('store_id', '=', $storeId)
                ->join('note', 'note.goods_id', '=', 'goods.id')
                ->orderby('note.created_at', 'desc')
                ->skip($offset)->take($limit)->get();
        } else {
            $noteList = $goodsModel::where('store_id', '=', $storeId)
                ->join('note', 'note.goods_id', '=', 'goods.id')
                ->skip($offset)->take($limit)->get();
        }

        foreach ($noteList as $note) {
            $note->forwardNum = ForwardService::getForwardNum($note->id);
            $note->likeNum = LikesService::getLikesNum($note->id);
            $note->commentNum = CommentService::getCommentNum($note->id);
        }

        //note
        if ($noteList) {
            return $this->success($noteList);
        } else {
            return $this->fail(300);
        }
    }


}