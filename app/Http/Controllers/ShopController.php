<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\CategoryModel;
use App\models\GoodsModel;
use App\models\CategorygoodsModel;
use App\models\StoreModel;
use App\models\NoteModel;
use App\models\CarModel;
use Illuminate\Support\Facades\DB;
use App\Http\Services\UserService;
use Validator;
class ShopController extends BaseController
{
    /**
     * 创建商品父级分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOneCategory(Request $request){
        $data = [];
        $data['category_name'] = $request->input('category_name');
        $data['pid'] = 0;
        $data['is_shop'] = CategoryModel::IS_SHOP;
        $rules = [
            'category_name' => 'required|string|min:1|max:20'
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $result = CategoryModel::create($data);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 创建商品子级分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSonCategory(Request $request){
        $data = $request->input('shop');
        $data['is_shop'] = CategoryModel::IS_SHOP;
        $rules = [
            'category_name' => 'required|string|min:1|max:20'
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $result = CategoryModel::create($data);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 增加商品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addGoods(Request $request){
        DB::beginTransaction();
        $data = $request->input('shop');
        $uid = UserService::getUid($request);
        $id = StoreModel::where('uid',$uid)
            ->select('id','status')->get()->toArray();
        $store_id = $id[0]['id'];
        $is_auth = $id[0]['status'];
        if($store_id){
            if($is_auth == StoreModel::IS_NOT_AUTH){
                return $this->fail(5006);//店铺未认证
            }
            $data['store_id'] = $store_id;
        }else{
            return $this->fail(50005);//没有店铺
        }

        if($data['is_agent'] == GoodsModel::IS_AGENT_1){//代理
            if(empty($data['pgoods_id'])){
                return $this->fail('300','请您选择代理的商品！');
            }else{
                $is_agent = GoodsModel::where('id',$data['pgoods_id'])
                    ->select('is_agent')->get()->toArray();
                if($is_agent[0]['is_agent'] == GoodsModel::IS_AGENT_1){
                    return $this->fail(50003);//不允许代理此产品
                }
            }
        }
        $rules = [
            'goods_name' => 'required|string|min:1|max:100',
            'goods_info' => 'required|string|min:1|max:240',
            'price' => 'required',
            'image_one' => 'required',
            'image_two' => 'required',
            'image_three' => 'required',
            'image_four' => 'required',
            'stock' => 'required',
            'is_shipping' => 'required',
            'postage' => 'required'
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $result = GoodsModel::create($data);
        $res = CategorygoodsModel::create(['category_id'=>$data['category_id'],'goods_id'=>$result->id]);
        if($result && $res){
            DB::commit();
            return $this->success();
        }else{
            DB::rollBack();
            return $this->fail('300');
        }
    }

    /**
     * 获取分类下的所有商品列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoodsList(Request $request){
        $category_id = $request->input('id');
        $categoryIds = CategorygoodsModel::where('category_id',$category_id)
            ->select('goods_id')
            ->get()->toArray();
        $goodsIds = array_column($categoryIds, 'goods_id');
        $goodsList = GoodsModel::whereIn('id',$goodsIds)
            ->get()->toArray();
        $data['data'] = $goodsList;
        $data['category_id'] = $category_id;
        return $this->success($data);
    }

    /**
     * 商品详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoodsDetail(Request $request){
        $goodsId = $request->input('id');
        $goodsDetail = GoodsModel::where('id',$goodsId)
            ->get()->toArray();
        return $this->success($goodsDetail);
    }

    /**
     * 店铺详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStoreDetail(Request $request){
        $storeId = $request->input('id');
        $storeDetail = StoreModel::where('id',$storeId)
            ->get()->toArray();
        return $this->success($storeDetail);
    }

    /**
     * 所属店铺下的商品列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeGoodsList(Request $request){
        $storeId = $request->input('id');
        $storeGoodsList = GoodsModel::where('store_id',$storeId)
            ->get()->toArray();
        return $this->success($storeGoodsList);
    }

    /**
     * 随机取相关商品列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function relateGoodsList(Request $request){
        $category_id = $request->input('id');
        $categoryIds = CategorygoodsModel::where('category_id',$category_id)
            ->select('goods_id')
            ->get()->toArray();
        $goodsIds = array_column($categoryIds, 'goods_id');
        $goodsList = GoodsModel::whereIn('id',$goodsIds)
                ->orderBy(DB::raw('RAND()'))
                ->take(GoodsModel::RELATE_GOODS)
                ->get()->toArray();
        return $this->success($goodsList);
    }

    /**
     * 我的店铺详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myStoreDetail(Request $request){
        $uid = UserService::getUid($request);
        $myStoreDetail = StoreModel::where('uid',$uid)
            ->get()->toArray();
        return $this->success($myStoreDetail);
    }

    /**
     * 搜索商品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchGoodsList(Request $request){
        $category_id = $request->input('category_id');
        $goods_name = $request->input('goods_name');
        $categoryIds = CategorygoodsModel::where('category_id',$category_id)
            ->select('goods_id')
            ->get()->toArray();
        $goodsIds = array_column($categoryIds, 'goods_id');
        $searchList = GoodsModel::whereIn('id',$goodsIds)->where('goods_name','like','%'.$goods_name.'%')
            ->get()->toArray();
        return $this->success($searchList);
    }

    /**
     * 商品下笔记列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoodsNote(Request $request){
        $goods_id = $request->input('id');
        $goodsNoteList = NoteModel::where('goods_id',$goods_id)
            ->get()->toArray();
        return $this->success($goodsNoteList);
    }

    /**
     * 添加商品到购物车
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCar(Request $request){
        $uid = UserService::getUid($request);
        $goods_id = $request->input('id');
        $time = date("Y-m-d H:i:s",time());
        $result = CarModel::create(['uid'=>$uid,'goods_id'=>$goods_id,'time'=>$time]);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 我的购物车列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myCarList(Request $request){
        $uid = UserService::getUid($request);
        $myGoodsList = CarModel::where('car.uid',$uid)
            ->join('goods','car.goods_id','=','goods.id')
            ->select('goods.*')
            ->get()->toArray();
        return $this->success($myGoodsList);
    }
}