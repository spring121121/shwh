<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;

use App\models\AddressModel;
use App\models\ScoreModel;
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
use Illuminate\Support\Facades\Cookie;
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
            'image_url' => 'required',
            'stock' => 'required',
            'is_shipping' => 'required',
            'postage' => 'required'
        ];
        $validator = Validator::make($data,$rules,config('message.goods'));
        if($validator->fails()){
            return $this->fail(50001,$validator->errors()->all());
        }
        $data['image_url'] = serialize(explode(',',$data['image_url']));
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
        $pid = $request->input('pid');
        if($category_id == CategorygoodsModel::GOODS_ALL){
            $goodsList = GoodsModel::where('status',GoodsModel::NORMAL)
                ->get()->toArray();
            foreach($goodsList as &$item){
                $item['image_url'] = unserialize($item['image_url']);
            }
            $data['data'] = $goodsList;
            $data['category_id'] = $category_id;
            return $this->success($data);
        }
        if($pid == CategorygoodsModel::ONE_CATEGORY){//一级分类
            $pids = CategoryModel::where('pid',$category_id)
                ->select('id')
                ->get()->toArray();
            $pIds = array_column($pids, 'id')?array_column($pids, 'id'):'';
            $categoryIds = CategorygoodsModel::whereIn('category_id',$pIds)
                ->select('goods_id')
                ->get()->toArray();
        }else{//二级分类
            $categoryIds = CategorygoodsModel::where('category_id',$category_id)
                ->select('goods_id')
                ->get()->toArray();
        }
        $goodsIds = array_column($categoryIds, 'goods_id')?array_column($categoryIds, 'goods_id'):'';
        $goodsList = GoodsModel::where('status',GoodsModel::NORMAL)->whereIn('id',$goodsIds)
            ->get()->toArray();
        foreach($goodsList as &$item){
            $item['image_url'] = unserialize($item['image_url']);
        }
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
        $goodsDetail = GoodsModel::where(['id'=>$goodsId,'status'=>GoodsModel::NORMAL])
            ->first()->toArray();
        $goodsDetail['image_url'] = unserialize($goodsDetail['image_url']);
        return $this->success($goodsDetail);
    }

    /**
     * 获取别人的店铺详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function otherStoreDetail(Request $request){
        $storeId = $request->input('id');
        $storeDetail = StoreModel::where('store.id', $storeId)
            ->join('user','store.uid','=','user.id')
            ->select('user.role','store.*')
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
        foreach($storeGoodsList as &$item){
            $item['image_url'] = unserialize($item['image_url']);
        }
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
     * 搜索商品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchGoodsList(Request $request){
        $category_id = $request->input('category_id');//搜索二级分类的goods
        $goods_name = $request->input('goods_name');//搜索二级分类的goods
        //二级分类
        $categoryIds = CategorygoodsModel::where('category_id',$category_id)
            ->select('goods_id')
            ->get()->toArray();
        $goodsIds = array_column($categoryIds, 'goods_id');
        $searchList = GoodsModel::whereIn('id',$goodsIds)->where('goods_name','like','%'.$goods_name.'%')
            ->where('status',GoodsModel::NORMAL)
            ->get()->toArray();
        foreach($searchList as &$item){
            $item['image_url'] = unserialize($item['image_url']);
        }
        $data['data'] = $searchList;
        $data['category_id'] = $category_id;
        return $this->success($data);
    }

    /**
     * 搜索商品无分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchList(Request $request){
        $goods_key = $request->input('goods_key');//搜索一级分类
        if(!empty($goods_key)){
            $searchList = GoodsModel::where('goods_name','like','%'.$goods_key.'%')
                ->where('status',GoodsModel::NORMAL)
                ->get()->toArray();
        }else{
            $searchList = GoodsModel::where('status',GoodsModel::NORMAL)
                ->get()->toArray();
        }
        foreach($searchList as &$item){
            $item['image_url'] = unserialize($item['image_url']);
        }
        $data['data'] = $searchList;
        $data['category_id'] = CategorygoodsModel::GOODS_ALL;
        return $this->success($data);
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
        $count = CarModel::where(['uid'=>$uid,'goods_id'=>$goods_id])->count();
        if($count != 0){
            return $this->fail('300','购物车已存在该商品！');
        }
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
        $resStore = $this->getMyOrderList($myGoodsList);
        return $this->success($resStore);
    }

    /**
     * 我的订单列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myOrderList(Request $request){
        $uid = UserService::getUid($request);
        $goods_ids = $request->input('goods_id');
        $goodsIds = explode(',',$goods_ids);
        $num = $request->input('num');
        $nums = explode(',',$num);
        $detail = $request->input('detail');
        if(!empty($detail)){
            $myGoodsList = GoodsModel::whereIn('id',$goodsIds)
                ->get()->toArray();
        }else{
            $myGoodsList = CarModel::where('car.uid',$uid)->whereIn('car.goods_id',$goodsIds)
                ->join('goods','car.goods_id','=','goods.id')
                ->orderByRaw("FIELD(car.goods_id, " . implode(", ", $goodsIds) . ")")
                ->select('goods.*')
                ->get()->toArray();
        }
        $total = 0;
        $postage = 0;
        foreach($myGoodsList as $key=>$goods_value){
            $myGoodsList[$key]['num'] = $nums[$key];
            $total += $goods_value['price']*$nums[$key];
            $postage += $goods_value['postage'];
        }
        $total = sprintf("%.2f",$total);
        $postage = sprintf("%.2f",$postage);
        $total_price = sprintf("%.2f",$postage+$total);
        $resStore = $this->getMyOrderList($myGoodsList);
        $data = ['data'=>$resStore,'total'=>$total,'postage'=>$postage,'total_price'=>$total_price];
        return $this->success($data);
    }

    public function getMyOrderList($myGoodsList){
        $store_ids = array_unique(array_column($myGoodsList,'store_id'));
        $resStore = StoreModel::whereIn('id',$store_ids)->orderByRaw("FIELD(id, " . implode(", ", $store_ids) . ")")
            ->select('id','name')
            ->get()->toArray();
        foreach($resStore as &$store_value){
            $key = 0;
            foreach($myGoodsList as $goods_value){
                $key += 0;
                if($goods_value['store_id'] == $store_value['id']){
                    $store_value['goods'][$key] = $goods_value;
                    $key++;
                }
            }
        }
        return $resStore;
    }

    /**
     * 购买商品创建记录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function purchase(Request $request){
        $uid = UserService::getUid($request);
        $address_id = $request->input('address_id');
        $goods_ids = $request->input('goods_id');
        $goodsIds = explode(',',$goods_ids);
        $num = $request->input('num');
        $nums = explode(',',$num);
        $detail = $request->input('detail');//从购物车下单
        if(!empty($detail)){
            $myGoodsList = GoodsModel::whereIn('id',$goodsIds)
                ->get()->toArray();
        }else{
            $myGoodsList = CarModel::where('car.uid',$uid)->whereIn('car.goods_id',$goodsIds)
                ->join('goods','car.goods_id','=','goods.id')
                ->select('goods.*')
                ->get()->toArray();
        }
        //查询店铺所属uid
        $array = [];//包含商品id,店铺id,店铺所属uid
        array_walk($myGoodsList, function($value, $key) use (&$array ){
            $array[$key]['id'] = $value['id'];
            $array[$key]['store_id'] = $value['store_id'];
            $array[$key]['is_agent'] = $value['is_agent'];
        });
        $store_ids = array_unique(array_column($array,'store_id'));
        $store_uid = StoreModel::whereIn('id',$store_ids)->select('uid','id')
            ->get()->toArray();
        foreach($array as &$value){
            foreach($store_uid as $store_uid_value){
                if($value['store_id'] == $store_uid_value['id']){
                    $value['agent_uid'] = $store_uid_value['uid'];
                }
            }
            if($value['is_agent'] == GoodsModel::IS_AGENT_1){//查询计算代理费用
                $value['agent_price'] = $this->agentPrice($value['id']);
            }else{
                $value['agent_price'] = '0.00';
            }
        }
        //数组组装
        $orderArr = [];
        $order = [];
        $pay = UserService::genPayOrderSn();//支付订单号
        $address = AddressModel::where('id',$address_id)->select('name','mobile','province','city','area','address_info')->first();
        foreach($myGoodsList as $key=>$goods_value){
            $orderArr['uid'] = $uid;//用户id
            $orderArr['num'] = $nums[$key];//购买数量
            $orderArr['address'] = $address['province'].' '.$address['city'].' '.$address['area'];//详细地址地址
            $orderArr['tel'] = $address['mobile'];//联系方式
            $orderArr['name'] = $address['name'];//联系人姓名
            $orderArr['goods_id'] = $goods_value['id'];//商品id
            $orderArr['order_sn'] = UserService::genOrderSn('sd_');//订单号
            $orderArr['pay_order_sn'] = $pay;//支付订单号
            $orderArr['total_price'] = $goods_value['price']*$nums[$key]+$goods_value['postage'];//总价含邮费
            $orderArr['store_id'] = $goods_value['store_id'];//店铺id
            $orderArr['goods_id'] = $goods_value['id'];//商品id
            $orderArr['unit_price'] = $goods_value['price'];//单价
            $orderArr['created_at'] = date("Y-m-d H:i:s",time());
            $orderArr['updated_at'] = date("Y-m-d H:i:s",time());
            foreach($array as $array_value){
                if($goods_value['id'] == $array_value['id']){
                    $orderArr['agent_uid'] = $array_value['agent_uid'];//代理商或商家id
                    $orderArr['is_agent'] = $array_value['is_agent'];//是否是代理
                    $orderArr['agent_price'] = $array_value['agent_price'];//代理商或商家id
                }
            }
            array_push($order,$orderArr);
        }
        $result = OrdersModel::insert($order);
        if($result){
            return $this->success(['pay_order_sn'=>$pay]);
        }else{
            return $this->fail('300');
        }
    }

    //计算代理费用
    public function agentPrice($goods_id){
        $pgoodsid = GoodsModel::where('id',$goods_id)->select('pgoods_id','price')
            ->first();//代理商店商品的价格和代理原商店的商品id
        $agent_price = '0.00';
        if($pgoodsid){
            $goods = $pgoodsid->toArray();//代理商品价格
            $pgoodprice = GoodsModel::where('id',$goods['pgoods_id'])->select('price')
                ->first();//原商店的商品价格
            if($pgoodprice){
                $p_goods = $pgoodprice->toArray();//原商品价格
                $agent_price = $goods['price'] - $p_goods['price'];
            }
        }
        return $agent_price;
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