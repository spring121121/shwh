<?php

namespace App\Http\Services;


use App\models\FocusModel;
use App\models\GradeModel;
use App\models\ScoreModel;
use App\models\UserModel;

class UserService
{
    public static function getUid($request)
    {
        $userInfo = $request->session()->get('userInfo');
        $uid = $userInfo['id'];
//        $uid = 1;
        return $uid;
    }

    //获取等级
    public static function getGrade($score)
    {
        $grade = GradeModel::select('id', 'min_score', 'max_score', 'grade_name')
            ->get()->toArray();
        $grade_name = '';
        foreach ($grade as $grade_value) {
            $min_score = $grade_value['min_score'];
            $max_score = $grade_value['max_score'];
            if ($score >= $min_score && $score <= $max_score) {
                $grade_name = $grade_value['grade_name'];
            }
        }
        return $grade_name;
    }

    //管理员权限
    public static function getUserRight($request)
    {
        $userInfo = $request->session()->get('userInfo');
        $role = $userInfo['role'];
        if ($role == 0) {
            return true;
        }
        return false;
    }

    /**
     * 判断是否关注过某个人
     * @param $request
     * @param $id
     * @return mixed
     */
    public static function judgeIsFocusUser($request, $id)
    {
        $uid = self::getUid($request);
        $focusModel = new FocusModel();
        $re = $focusModel::where('uid', '=', $uid)->where('beuid', '=', $id)->exists();
        return $re;
    }
    
    //获取订单号
    public static function genOrderSn($letter = '') {
        $time = explode (" ", microtime ());
        $timeArr = explode('.',$time [0]);
        $mtime = array_pop($timeArr);
        $fulltime = $letter.$time[1].$mtime;
        return $fulltime;
    }

    //增加积分
    public static function addScore($request,$type,$score){
        $data = [];
        $uid = self::getUid($request);
        $data['uid'] = $uid;
        $data['type'] = $type;
        $data['score'] = $score;
        $res = ScoreModel::create($data);
        $result = UserModel::where(['id'=>$uid,'status'=>UserModel::NORMAL_STATUS])->update(['score'=>$score]);
        if($res && $result){
            return true;
        }else{
            return false;
        }
    }
}

