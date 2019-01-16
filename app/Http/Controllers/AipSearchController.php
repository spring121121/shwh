<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Services\AipImageSearchService;

class AipSearchController extends BaseController
{

    /**
     * 相同图入库
     * @param Request $request
     * @return array
     */
    public function sameHqAdd(Request $request){

        $imageContent = file_get_contents($request->file('source')->getPathname());
        $aipImageSearch = new AipImageSearchService();
        $re = $aipImageSearch->sameHqAdd($imageContent,$request->input("name"),$request->input('id'));
        return $re;
    }


    /**
     * 相同图检索
     * @param Request $request
     * @return array
     */
    public function sameHqSearch(Request $request){
        $imageContent = file_get_contents($request->file('source')->getPathname());
        $aipImageSearch = new AipImageSearchService();
        $re = $aipImageSearch->sameHqSearch($imageContent);
        return $re;
    }


}