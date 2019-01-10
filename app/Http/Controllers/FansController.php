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
    public function myFans(Request $request){
        $uid = $request->input('uid');
        $fanCount = FocusModel::where('uid',$uid)
           ->count();
        return $this->success(['count'=>$fanCount]);
    }

    /**
     * 关注
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function focus(Request $request){
        $beuid = UserService::getUid($request);
        $uid = $request->input('uid');
        $result = FocusModel::create(['uid'=>$uid,'beuid'=>$beuid]);
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
    public function myFansList(Request $request){
        $uid = UserService::getUid($request);
        $fans = FocusModel::where('focus.uid',$uid)
            ->join('user','focus.beuid','=','user.id')
            ->select('user.id','user.photo','user.nickname','user.score')
            ->get()->toArray();
        $res = $this->getList($fans);
        return $this->success($res);
    }

    /**
     * 我的粉丝前三天列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function beforeFansList(Request $request){
        $uid = UserService::getUid($request);
        $time = date("Y-m-d H:i:s",strtotime('-3 day'));
        $fans = FocusModel::where('focus.uid','=',$uid)->where('focus.created_at','>=',$time)
            ->join('user','focus.beuid','=','user.id')
            ->select('user.id','user.photo','user.nickname','user.score')
            ->get()->toArray();
        $res = $this->getList($fans);
        return $this->success($res);
    }

    public function getList($fans){
        $grade = GradeModel::select('id','min_score','max_score','grade_name')
            ->get()->toArray();
        foreach($grade as $grade_value){
            $min_score = $grade_value['min_score'];
            $max_score = $grade_value['max_score'];
            foreach($fans as &$focus_value){
                $scores_value = $focus_value['score'];
                if($scores_value>=$min_score && $scores_value<=$max_score){
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
    public function myFocusList(Request $request){
        $uid = UserService::getUid($request);
        $focus = FocusModel::where('focus.beuid',$uid)
            ->join('user','focus.uid','=','user.id')
            ->select('user.id','user.photo','user.nickname','user.score')
            ->get()->toArray();
        $res = $this->getList($focus);
        return $this->success($res);
    }

    /**
     * 我的收藏列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myCollectList(Request $request){
        $uid = UserService::getUid($request);
        $collectList = CollectModel::where('collect.uid',$uid)
            ->join('note','collect.note_id','=','note.id')
            ->join('user','collect.uid','=','user.id')
            ->select('note.id','collect.created_at','user.photo','user.nickname','note.title','note.content as note_content','note.image_one_url')
            ->get()->toArray();
        return $this->success($collectList);
    }

    /**
     * 我获赞的数量
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myPraise(Request $request){
        $uid = $request->input('uid');
        $noteId = $request->input('noteid');
        $praiseCount = LikesModel::where(['uid'=>$uid,'note_id'=>$noteId])
            ->count();
        return $this->success(['count'=>$praiseCount]);
    }

    /**
     * 推荐列表 暂时以粉丝最多
     * @return \Illuminate\Http\JsonResponse
     */
    public function recommendList(Request $request){
        $uid = UserService::getUid($request);
        $limit = FocusModel::LIMIT;
        $offset = $request->input('offset')*$limit;
        $ids = FocusModel::where('beuid',$uid)
            ->select('uid')
            ->get()->toArray();
        $uids = array_column($ids, 'uid');
        $focus = FocusModel::whereNotIn('uid',$uids)
            ->select(DB::raw('uid,count(id) as count'))
            ->groupBy('uid')->orderBy(DB::raw('count(id)'),'desc')->offset($offset)->limit($limit)->get()->toArray();
        $uidds = array_column($focus, 'uid');
        $recommend = UserModel::whereIn('id',$uidds)->orderByRaw("FIELD(id, " . implode(", ", $uidds) . ")")->select('id','photo','nickname','score')
            ->get()->toArray();//按照id顺序排列
        $res = $this->getList($recommend);
        return $this->success($res);
    }
}