<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;

use App\models\UserModel;
use Illuminate\Http\Request;
use App\models\CategoryModel;
use App\models\GoodsModel;
use App\models\CategorygoodsModel;
use App\models\StoreModel;
use App\models\NoteModel;
use App\models\CarModel;
use App\models\OrdersModel;
use App\models\BrowseModel;
use App\models\SettleModel;
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
        $validator = Validator::make($data,$rules,config('message.goods'));
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
     * 购买商品记录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function purchase(Request $request){
        $uid = UserService::getUid($request);
        DB::beginTransaction();
        $data = $request->input('order');
        $rules = [
            'goods_id' => 'required|numeric',
            'num' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'is_agent' => 'required|numeric',
            'store_id' => 'required|numeric',
        ];
        $validator = Validator::make($data,$rules,config('message.order'));
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $data['uid'] = $uid;
        $data['total_price'] = $data['unit_price']*$data['num'];
        $result = OrdersModel::create($data);
        if($data['is_agent'] == GoodsModel::IS_AGENT_1){//代理生成两条订单
            $data['porder_id'] = $result->id;
            $res = OrdersModel::create($data);
            if($result && $res){
                DB::commit();
                return $this->success();
            }else{
                DB::rollBack();
                return $this->fail('300');
            }
        }else {//非代理
            if ($result) {
                DB::commit();
                return $this->success();
            } else {
                DB::rollBack();
                return $this->fail('300');
            }
        }
    }

    /**
     * 支付成功并结算
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function payment(Request $request){
        //支付成功（待写）
        $uid = UserService::getUid($request);
        $order_sn = '001';
        $whereApply = ['order_sn'=>$order_sn,'uid'=>$uid,'status'=>OrdersModel::IS_PAYMENT,'porder_id'=>0];
        $total_price = OrdersModel::where($whereApply)->sum('total_price');
        //更新扣款 用户（买家）钱包
//        $userWallet = UserModel::where('id',$uid)->select('id','wallet')->get()->toArray();
//        if($userWallet < $total_price){
//            return $this->fail(60002);//余额不足
//        }
//        $deduction = UserModel::where('id',$uid)->update(['wallet'=>$userWallet-$total_price]);


        //更新增款 用户（店家，卖家）钱包


        //买家确认已签收，开始结算
        $whereReceive = ['order_sn'=>$order_sn,'uid'=>$uid,'status'=>OrdersModel::IS_RECEIVE,'porder_id'=>0,'is_agent'=>GoodsModel::IS_AGENT_1];
        //(1)更新扣款 用户（店铺，代理商品）钱包




        //(2)更新增款 商家（代理商家商品）钱包




        //(3)更新结算表数据

        $settle_porder = OrdersModel::where($whereReceive)->select('id as order_id','store_id','goods_id')->get()->toArray();
        //$result = SettleModel::insert($settle_porder);
        if ($result) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
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

    /**
     * 浏览记录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRecord(Request $request){
        $uid = UserService::getUid($request);
        $type = $request->input('type');
        $browse_id = $request->input('browse_id');
        $rules = [
            'type' => 'required',
            'browse_id' => 'required',
        ];
        $data = ['uid'=>$uid,'type'=>$type,'browse_id'=>$browse_id];
        $validator = Validator::make($data,$rules,config('message.browse_record'));
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $res = BrowseModel::create($data);
        if ($res) {
            return $this->success();
        } else {
            return $this->fail('300');
        }
    }

    /**
     * 商品或笔记浏览次数
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function browseCount(Request $request){
        $type = $request->input('type');
        $browse_id = $request->input('browse_id');
        $count = BrowseModel::where(['type'=>$type,'browse_id'=>$browse_id])->count();
        return $this->success(['count'=>$count]);
    }
}