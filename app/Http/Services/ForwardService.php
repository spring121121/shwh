<?php

namespace App\Http\Services;

use App\models\ForwardModel;
use App\User;

class ForwardService
{
    public static $forwardModel;

    public static function getForwardModel()
    {
        self::$forwardModel = new ForwardModel();
    }

    public static function getForwardNum($noteId)
    {
        self::getForwardModel();

        return self::$forwardModel->where('note_id', '=', $noteId)->count();

    }

    /**
     * 转发
     * @param $request
     * @param $beuid
     * @param $noteId
     * @return mixed
     */
    public function forwardNote($request,$beuid,$noteId){
        $uid = UserService::getUid($request);
        self::getForwardModel();
        self::$forwardModel->uid = $uid;
        self::$forwardModel->beuid = $beuid;
        self::$forwardModel->note_id = $noteId;
        return self::$forwardModel->save();
    }



}

