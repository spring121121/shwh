<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2019/1/17
 * Time: 16:41
 */
namespace App\Http\Controllers;

use App\models\UserModel;
use Illuminate\Http\Request;
use App\models\CollectModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Services\UserService;
class FactoryController extends BaseController {

    public function fatoryList(Request $request) {
        $condition = [
            [ 'user.id','>',0],
            ['store.logo_pic_url','<>','']
        ];
        $list = UserModel::leftJoin("store","user.id","=","store.uid")
            ->where($condition)
            ->select("user.*","store.name as store_name","store.logo_pic_url")
            ->get()->toArray();
        return view("indexDetail/factory",['list'=>$list]);//
    }

}