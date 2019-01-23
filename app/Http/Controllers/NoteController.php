<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;

use App\models\CommentModel;
use App\models\ForwardModel;
use App\models\GoodsModel;
use App\models\LikesModel;
use App\models\NoteModel;
use Illuminate\Http\Request;
use App\Http\Services\ForwardService;
use App\Http\Services\LikesService;
use App\Http\Services\CommentService;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Output\NullOutput;

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
     * get other NoteList
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOtherNoteList(Request $request, $id)
    {
        $noteModel = new NoteModel();
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $offset = ($page - 1) * $limit;
        $noteList = $noteModel::where('uid', '=', $id)->skip($offset)->take($limit)->get();
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

    /**
     * 根据点赞数来排名
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHotNote(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $offset = ($page - 1) * $limit;
        $noteList = DB::select("SELECT count(likes.id) as likeNum,note.* FROM note left join `likes` on likes.note_id =note.id where note.deleted_at is null GROUP BY note.id  order by likeNum desc limit :offset,:limit", ['limit' => $limit, 'offset' => $offset]);


        foreach ($noteList as $note) {
            $note->forwardNum = ForwardService::getForwardNum($note->id);
        }

        return $this->success($noteList);
    }

    /**
     * 回复评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function replayComment(Request $request)
    {
        $replyUid = UserService::getUid($request);//回复人uid
        $data = $request->input('reply');
        $rules = [
            'to_cid' => 'required|numeric',
            'note_id' => 'required|numeric',
            'content' => 'required|max:200',
            'comment_id' => 'required|numeric'
        ];
        $validator = Validator::make($data, $rules, config('message.comment'));
        if ($validator->fails()) {
            return $this->fail(50001, $validator->errors()->all());
        }
        $data['uid'] = $replyUid;
        $res = CommentModel::create($data);
        if ($res) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 笔记点赞
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeNote(Request $request)
    {
        $data = [];
        $uid = UserService::getUid($request);
        $note_id = $request->input('note_id');
        $data['note_id'] = $note_id;
        $rules = [
            'note_id' => 'required|numeric',
        ];
        $validator = Validator::make($data, $rules, config('message.likes'));
        if ($validator->fails()) {
            return $this->fail(50001, $validator->errors()->all());
        }
        $beuid = NoteModel::where('id', $note_id)->first();
        if ($beuid) {
            $data['beuid'] = $beuid->uid;
        }
        $data['uid'] = $uid;
        $res = LikesModel::create($data);
        if ($res) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 笔记转发
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forwardNote(Request $request)
    {
        $data = [];
        $uid = UserService::getUid($request);
        $note_id = $request->input('note_id');
        $data['note_id'] = $note_id;
        $rules = [
            'note_id' => 'required|numeric',
        ];
        $validator = Validator::make($data, $rules, config('message.forward'));
        if ($validator->fails()) {
            return $this->fail(50001, $validator->errors()->all());
        }
        $beuid = NoteModel::where('id', $note_id)->first();
        if ($beuid) {
            $data['beuid'] = $beuid->uid;
        }
        $data['uid'] = $uid;
        $res = ForwardModel::create($data);
        if ($res) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 获取某商品下笔记列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoodsNoteList(Request $request)
    {
        $goods_id = $request->input('goods_id');
        $noteList = NoteModel::where(['goods_id' => $goods_id, 'status' => NoteModel::CHECK_STATUS])
            ->get()->toArray();
        return $this->success($noteList);
    }

    /**
     * 根据笔记ID获取笔记详情
     * @param $noteId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNoteInfoByNoteId($noteId)
    {
        $noteModel = new NoteModel();
        $note = $noteModel::where("id", '=', $noteId);
        $note->forwardNum = ForwardService::getForwardNum($note->id);
        $note->likeNum = LikesService::getLikesNum($note->id);
        $note->commentNum = CommentService::getCommentNum($note->id);
        return $this->success($note);
    }

    /**
     * 笔记详情页面
     */
    public function noteDetail(Request $request, $noteId)
    {
        $noteModel = new NoteModel();
        $note = $noteModel::find($noteId)->toArray();
        $userInfo = UserService::getUserInfoByUid($request, $note['uid']);
        $note['photo'] = $userInfo['photo'];
        $note['nickname'] = $userInfo['nickname'];
        $note['grade'] = $userInfo['grade'];
        $note['is_foucus'] = $userInfo['is_foucus'];

//        $note->forwardNum = ForwardService::getForwardNum($note['id']);
//        $note->likeNum = LikesService::getLikesNum($note['id']);
//        $note->commentNum = CommentService::getCommentNum($note['id']);

        return view('indexDetail/noteDetail', ['noteDetail' => $note]);
    }


    /**
     * 根据店铺id查询该店铺下相应的笔记
     * @param $storeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNoteByStoreId($storeId)
    {
        $goodsModel = new GoodsModel();
        $noteList = $goodsModel::where('goods.store_id', '=', $storeId)
            ->select("note.id","note.uid", "note.title", "note.content", "note.image_one_url", "user.photo")
            ->join("note", 'note.goods_id', '=', 'goods.id')
            ->join("user", "user.id", "=", 'note.uid')->get();
        foreach ($noteList as $note) {
            $note->likeNum = LikesService::getLikesNum($note->id);
        }

        return $this->success($noteList);
    }


}