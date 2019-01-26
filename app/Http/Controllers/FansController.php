<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\FocusModel;
use App\models\CollectModel;
use App\models\LikesModel;
use App\models\GradeModel;
use App\models\UserModel;
use Illuminate\Support\Facades\DB;
use App\Http\Services\UserService;
use Validator;

class FansController extends BaseController
{
    /**
     * 我的粉丝数量，被关注的用户数量
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myFans(Request $request)
    {
        //默认查询的是我的粉丝数量，也可以传入uid查询某个用户的粉丝数量
        $uid = $request->input('uid', UserService::getUid($request));
        $fanCount = FocusModel::where('beuid', $uid)
            ->count();
        return $this->success(['count' => $fanCount]);
    }


    /**
     * 关注
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function focus(Request $request)
    {
        //1.先检测是否登录了
        $uid = UserService::getUid($request);
        if($uid == 0){
            return $this->fail(50009);
        }

        $beuid = $request->input('uid');

        //先查下表里是否存在某个用户关注过该用户
        $re = FocusModel::where('uid', '=', $uid)->where('beuid', '=', $beuid)->withTrashed()->first();
        if (!empty($re)) {
            $result = FocusModel::where('id', '=', $re->id)->restore();//恢复软删除
        } else {
            $result = FocusModel::create(['uid' => $uid, 'beuid' => $beuid]);
        }

        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 取消关注
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelFocus(Request $request)
    {
        $uid = UserService::getUid($request);
        $beuid = $request->input('uid');

        $result = FocusModel::where('uid', '=', $uid)->where('beuid', '=', $beuid)->delete();//软删除
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 我的粉丝列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myFansList(Request $request)
    {
        //默认查询的是我的粉丝列表，也可以传入uid查询某个用户的粉丝列表
        $uid = $request->input('uid', UserService::getUid($request));
        $fans = FocusModel::where('focus.beuid', $uid)
            ->join('user', 'focus.uid', '=', 'user.id')
            ->select('user.id', 'user.photo', 'user.nickname', 'user.score', 'user.sex')
            ->get()->toArray();
        $res = $this->getList($fans);//关注我的

        $myuid = FocusModel::where('uid', $uid)->select('beuid')->get()->toArray();//我关注的uid

        $myuids = array_column($myuid, 'beuid');
        foreach ($res as &$value) {
            if (in_array($value['id'], $myuids)) {
                $value['is_focus'] = FocusModel::IS_FOCUS;//已关注
            } else {
                $value['is_focus'] = FocusModel::NO_FOCUS;//未关注
            }
        }
        return $this->success($res);
    }

    /**
     * 我的粉丝前三天列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function beforeFansList(Request $request)
    {
        //默认查询的是我的粉丝列表，也可以传入uid查询某个用户的粉丝列表
        $uid = $request->input('uid', UserService::getUid($request));
        $time = date("Y-m-d H:i:s", strtotime('-3 day'));
        $fans = FocusModel::where('focus.beuid', '=', $uid)->where('focus.created_at', '>=', $time)
            ->join('user', 'focus.uid', '=', 'user.id')
            ->select('user.id', 'user.photo', 'user.nickname', 'user.score', 'user.sex')
            ->get()->toArray();
        $res = $this->getList($fans);
        $myuid = FocusModel::where('uid', $uid)->select('beuid')->get()->toArray();//我关注的uid
        $myuids = array_column($myuid, 'beuid');
        foreach ($res as &$value) {
            if (in_array($value['id'], $myuids)) {
                $value['is_focus'] = FocusModel::IS_FOCUS;//已关注
            } else {
                $value['is_focus'] = FocusModel::NO_FOCUS;//未关注
            }
        }
        return $this->success($res);
    }

    public function getList($fans)
    {
        $grade = GradeModel::select('id', 'min_score', 'max_score', 'grade_name')
            ->get()->toArray();
        foreach ($grade as $grade_value) {
            $min_score = $grade_value['min_score'];
            $max_score = $grade_value['max_score'];
            foreach ($fans as &$focus_value) {
                $scores_value = $focus_value['score'];
                if ($scores_value >= $min_score && $scores_value <= $max_score) {
                    $focus_value['grade_name'] = $grade_value['grade_name'];
                }
            }
        }
        return $fans;
    }

    /**
     * 我关注的用户列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myFocusList(Request $request)
    {
        //默认查询的是我关注的,如果不传uid就是查询任意一个uid所关注的用户列表
        $uid = $request->input('uid', UserService::getUid($request));
        $focus = FocusModel::where('focus.uid', $uid)
            ->join('user', 'focus.beuid', '=', 'user.id')
            ->select('user.id', 'user.photo', 'user.nickname', 'user.score', 'user.sex')
            ->get()->toArray();
        $res = $this->getList($focus);
        return $this->success($res);
    }

    /**
     * 我的收藏列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myCollectList(Request $request)
    {
        $uid = $request->input('uid', UserService::getUid($request));
        $collectList = CollectModel::where('collect.uid', $uid)
            ->join('note', 'collect.note_id', '=', 'note.id')
            ->join('user', 'collect.uid', '=', 'user.id')
            ->select('note.id', 'collect.created_at', 'user.photo', 'user.nickname', 'note.title', 'note.content as note_content', 'note.image_one_url')
            ->get()->toArray();
        return $this->success($collectList);
    }

    /**
     * 我获赞的数量
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myPraise(Request $request)
    {
        $uid = $request->input('uid', UserService::getUid($request));
        $noteId = $request->input('noteid');
        $praiseCount = LikesModel::where(['uid' => $uid, 'note_id' => $noteId])
            ->count();
        return $this->success(['count' => $praiseCount]);
    }

    /**
     * 推荐列表 暂时以粉丝最多
     * @return \Illuminate\Http\JsonResponse
     */
    public function recommendList(Request $request)
    {
        $uid = UserService::getUid($request);
        $limit = FocusModel::LIMIT;
        $offset = $request->input('offset') * $limit;
        //用于排除我已经关注过的人
        $ids = FocusModel::where('uid', $uid)
            ->select('beuid')
            ->groupBy('beuid')
            ->get()->toArray();
        $uids = array_column($ids, 'beuid');
        if ($uids) {

            $focus = FocusModel::whereNotIn('beuid', $uids)->whereNotIn('beuid',[$uid])
                ->select(DB::raw('beuid,count(id) as count'))
                ->groupBy('beuid')
                ->orderBy('count', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get()
                ->toArray();

            $uidds = array_column($focus, 'beuid');

            if($uidds){
                $recommend = UserModel::whereIn('id', $uidds)->orderByRaw("FIELD(id, " . implode(", ", $uidds) . ")")->select('id', 'photo', 'nickname', 'score', 'sex')
                    ->get()->toArray();//按照id顺序排列
            }else{
                $recommend = [];
            }
            $res = $this->getList($recommend);
        } else {
            $recommend = UserModel::select('id', 'photo', 'nickname', 'score', 'sex')->whereNotIn('id',[$uid])->offset($offset)->limit($limit)
                ->get()->toArray();
            $res = $this->getList($recommend);
        }
        return $this->success($res);
    }

    /**
     * 判断当前登录的用户是否关注过此用户
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function judgeFocus(Request $request)
    {
        $uid = UserService::getUid($request);
        $beuid = $request->input("beuid");
        $isFocus = FocusModel::where('uid', $uid)->where('beuid', $beuid)->exists();

        return $this->success(['is_focus'=>$isFocus]);
    }
}