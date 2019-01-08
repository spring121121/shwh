<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use App\models\CategoryModel;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends BaseController
{

    /**
     * 获取分类列表
     * @param Request $request
     * @param $isShop
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryList(Request $request,$isShop)
    {
        $pid = $request->input('pid',0);
        $categoryModel = new CategoryModel();
        $categoryList = $categoryModel::where('is_shop','=',$isShop)->where('pid','=',$pid)->get();
        return $this->success($categoryList);
    }


}