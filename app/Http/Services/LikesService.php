<?php

namespace App\Http\Services;

use App\models\LikesModel;

class LikesService
{
    public static $likesModel;

    public static function getLikesModel()
    {
        self::$likesModel = new LikesModel();
    }

    public static function getLikesNum($noteId)
    {
        self::getLikesModel();
        return self::$likesModel->where('note_id', '=', $noteId)->count();

    }
}

