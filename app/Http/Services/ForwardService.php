<?php

namespace App\Http\Services;

use App\models\ForwardModel;

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

        $fo = new ForwardModel();


        return self::$forwardModel->where('note_id', '=', $noteId)->count();

    }
}

