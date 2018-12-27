<?php

namespace App\Http\Services;

use App\models\CommentModel;

class CommentService
{
    public static $commentModel;

    public static function getCommentModel()
    {
        self::$commentModel = new CommentModel();
    }

    public static function getCommentNum($noteId)
    {
        self::getCommentModel();

        return self::$commentModel->where('note_id', '=', $noteId)->count();

    }
}

