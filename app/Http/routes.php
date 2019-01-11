<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Cookie;
Route::get('/', function () {
    return view('welcome');
});

/*****************LoginController***********************************/
Route::post('login','LoginController@login');//登录

/*****************RegisterController********************************/
Route::post('register','RegisterController@register');//注册

Route::get('test','TestController@test');//注册

/**
 * 如果该接口是需要在登录的状态下才能获取的，请把路由写在checkLogin组里
 */
Route::group(['middleware'=>'checkLogin'],function(){
    /*****************AddressController**********************************/
    Route::get('addressList','AddressController@addressList');//获取我的收货地址
    Route::post('addAddress','AddressController@addAddress');//添加收货地址
    Route::post('updateAddress','AddressController@updateAddress');//修改收货地址
    Route::post('setDefaultAddress/{id}','AddressController@setDefaultAddress');//修改默认收货地址
    Route::get('addressDetail','AddressController@addressDetail');//收货地址详情
    Route::post('deleteAddress/{id}','AddressController@deleteAddress');//删除收货地址

    /*****************UserController********************/
    Route::get('getUserInfo','UserController@getUserInfo');//获取我的个人信息
    Route::get('updateUserInfo','UserController@updateUserInfo');//更新我的个人信息
    Route::get('getMyUserInfo','UserController@getMyUserInfo');//获取我的个人信息

    /*********************分销**************************************/
    Route::post('addAgentGoods','AgentController@addAgentGoods');

    Route::post('upload','UploadController@upload');//文件上传

    Route::get('getMyNoteList','NoteController@getMyNoteList');//获取我的原创笔记列表

    Route::get('getMyCollectNote','CollectController@getMyCollectNote');//获取我收藏的笔记
    Route::post('deleteNote','NoteController@deleteNote');//删除笔记
    Route::post('deleteNoteNotOnly','NoteController@deleteNoteNotOnly');//删除多个笔记
    Route::get('searchNote/{keyword}','NoteController@searchNote');//搜索笔记
    Route::get('getNoteListByStoreId','NoteController@getNoteListByStoreId');//根据店铺ID查询相应的笔记
    Route::get('getMyLikeNote','LikeController@getMyLikeNote');//获取我点赞的笔记


    /*****************InformationController消息接口********************************/
    Route::post('pubSysMessage','InformationController@pubSysMessage');//管理员发布系统消息
    Route::get('getSysMessage','InformationController@getSysMessage');//系统消息列表
    Route::post('commentNote','InformationController@commentNote');//评论笔记
    Route::get('getCommentMessage','InformationController@getCommentMessage');//笔记列表
    Route::get('readSysMessage','InformationController@readSysMessage');//已读系统消息

    /*****************FansController关注，粉丝接口********************************/
    Route::post('focus','FansController@focus');//关注
    Route::get('myFans','FansController@myFans');//我的粉丝数量
    Route::get('myFansList','FansController@myFansList');//我的粉丝列表
    Route::get('beforeFansList','FansController@beforeFansList');//前几天我的粉丝列表
    Route::get('myFocus','FansController@myFocus');//我的关注数量
    Route::get('myFocusList','FansController@myFocusList');//我的关注列表
    Route::get('recommendList','FansController@recommendList');//推荐关注列表
    Route::get('myCollectList','FansController@myCollectList');//我的收藏列表
    Route::get('myPraise','FansController@myPraise');//我的获赞数量

    /*****************FeedbackController意见反馈接口********************************/
    Route::post('feedback','FeedbackController@feedback');//意见反馈
    Route::get('readFeedback','FeedbackController@readFeedback');//已读意见反馈
    Route::get('feedbackList','FeedbackController@feedbackList');//意见反馈列表
    Route::get('feedbackDetail','FeedbackController@feedbackDetail');//意见反馈列表

    /*****************StoreController店铺接口********************************/
    Route::post('addStore','StoreController@addStore');//新增店铺
    Route::post('updateStore','StoreController@updateStore');//修改店铺
    Route::get('authStore','StoreController@authStore');//认证店铺
    Route::get('storeList','StoreController@storeList');//店铺列表
    Route::get('storeDetail','StoreController@storeDetail');//店铺详情
    Route::get('uploadAuth','StoreController@uploadAuth');//上传店铺认证图
    Route::get('getStoreListBySearch','StoreController@getStoreListBySearch');//获取相应角色的店铺列表

    /*****************ShopController商店接口********************************/
    Route::post('createOneCategory','ShopController@createOneCategory');//新增商品一级分类
    Route::post('createSonCategory','ShopController@createSonCategory');//新增商品二级分类
    Route::post('addGoods','ShopController@addGoods');//增加商品
    Route::get('getGoodsList','ShopController@getGoodsList');//获取分类下的所有商品列表
    Route::get('getGoodsDetail','ShopController@getGoodsDetail');//商品详情
    Route::post('purchase','ShopController@purchase');//购买商品记录
    Route::post('payment','ShopController@payment');//支付成功并结算
    Route::get('getStoreDetail','ShopController@getStoreDetail');//店铺详情
    Route::get('myStoreDetail','ShopController@myStoreDetail');//我的店铺详情
    Route::get('storeGoodsList','ShopController@storeGoodsList');//所属店铺下的商品列表
    Route::get('relateGoodsList','ShopController@relateGoodsList');//随机取10条相关商品列表
    Route::get('searchGoodsList','ShopController@searchGoodsList');//搜索商品
    Route::get('getGoodsNote','ShopController@getGoodsNote');//商品下笔记列表
    Route::post('addCar','ShopController@addCar');//增加商品购物车
    Route::get('myCarList','ShopController@myCarList');//我的购物车列表
});




/**************************分类获取***********************************/
Route::get('categoryList/{isShop}','CategoryController@categoryList');



/*****************ValidateCodeController********************************/
Route::get('getCodeImg','ValidateCodeController@getCodeImg');
Route::get('checkValidateCode/{code}','ValidateCodeController@checkValidateCode');



Route::get('getAllProvinces','AreasController@getAllProvinces');
Route::get('getCitiesByProvince/{provinceId}','AreasController@getCitiesByProvince');
Route::get('getAreasByCityId/{cityId}','AreasController@getAreasByCityId');


/************************前端路由*********************************/

Route::get('wap/login_index', function () {//登录首页
    return view('personal/login-index');
});
Route::get('wap/login', function () {//手机号登陆
    return view('personal/login');
});
Route::get('wap/register', function () {//注册页面
    return view('personal/register');
});

Route::group(['middleware'=>'checkLogin'],function(){
    Route::get('wap/personal', function () {//个人中心
        return view('personal/personal-center');
    });
    Route::get('wap/personal_data', function () {//个人资料
        return view('personal/personal-data');
    });
    Route::get('wap/message_center', function () {//消息中心
        return view('personal/message-center');
    });
    Route::get('wap/my_note', function () {//我的笔记
        return view('personal/my-note');
    });
    Route::get('wap/thumbs_up', function () {//点赞笔记
        return view('personal/thumbs-up');
    });
    Route::get('wap/reply_comment', function () {//回复评论
        return view('personal/reply-comment');
    });
    Route::get('wap/follow_interest', function () {//关注页面
        return view('personal/follow-interest');
    });
    Route::get('wap/apply_certification', function () {//申请认证
        return view('personal/apply-certification');
    });
    Route::get('wap/collection', function () {//收藏夹
        return view('personal/collection');
    });
    Route::get('wap/coupon', function () {//优惠券
        return view('personal/coupon');
    });
    Route::get('wap/edit_address', function () {//编辑收货地址
        return view('personal/edit-address');
    });
    Route::get('wap/factory', function () {//工厂认证
        return view('personal/factory');
    });
    Route::get('wap/feedback', function () {//意见反馈
        return view('personal/feedback');
    });
    Route::get('wap/ID_card', function () {//身份证认证
        return view('personal/ID-card');
    });
    Route::get('wap/museum', function () {//博物馆认证
        return view('personal/museum');
    });
    Route::get('wap/my_address', function () {//我的收货地址
        return view('personal/my-address');
    });
    Route::get('wap/my_order', function () {//我的订单
        return view('personal/my-order');
    });
    Route::get('wap/new_address', function () {//新增收货地址
        return view('personal/new-address');
    });
    Route::get('wap/order_details', function () {//订单详情
        return view('personal/order-details');
    });
    Route::get('wap/other_home', function () {//别人的主页
        return view('personal/other-home');
    });
    Route::get('wap/pay_order', function () {//订单详情-订单支付页面
        return view('personal/pay-order');
    });
    Route::get('wap/pinglun_edit', function () {//评论页面
        return view('personal/pinglun-edit');
    });
    Route::get('wap/pinglun_list', function () {//评论列表
        return view('personal/pinglun-list');
    });
    Route::get('wap/recommend', function () {//推荐消息
        return view('personal/recommend');
    });
    Route::get('wap/store', function () {//店铺首页
        return view('personal/store');
    });
    Route::get('wap/store_setting', function () {//店铺设置
        return view('personal/store-setting');
    });
    Route::get('wap/write_note', function () {//写笔记
        return view('personal/write-note');
    });
});









