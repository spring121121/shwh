<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2019/1/28
 * Time: 9:52
 */
namespace App\Http\Controllers;
header("Access-Control-Allow-Origin: *");

use App\models\CommentModel;
use App\models\DemandModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
class ActiveController extends BaseController {

    public function detail(Request $request,$active_id) {
        $demand = new DemandModel();
        $active = $demand::find($active_id)->toArray();
        $list = [];
        try {
            DB::setFetchMode(PDO::FETCH_ASSOC);
            $list = DB::select("SELECT c.id,c.note_id,c.uid,c.to_cid,c.to_uid,c.content,c.root_cid,c.created_at,u.photo,u.nickname,u2.nickname AS to_nickname 
FROM comment c 
LEFT JOIN user u ON c.uid=u.id 
LEFT JOIN user u2 ON c.to_uid=u2.id 
WHERE c.note_id=? AND c.type=2",[$active_id]);
        }catch (\Exception $e) {
            exit($e->getMessage());
        }
        $list = $this->recursion($list);
        return view('indexDetail/active/activeDetail', ['active' => $active,'commentList'=>$list]);
    }

    private function recursion($array,$to_cid=0) {
        $to_array = [];
        foreach ($array as $v) {
            if($v['root_cid'] == $to_cid) {
                $v['child'] = $this->recursion($array,$v['id']);
                $to_array[] = $v;
            }
        }
        return $to_array;
    }

}