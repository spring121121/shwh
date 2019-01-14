<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\models\UserModel;
use App\Http\Services\ValidateCodeService;

class CommentController extends BaseController
{

    public function test()
    {
        echo 'ITS OK !!';
    }


}