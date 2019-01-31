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

Route::get('test','TestController@test');//测试
Route::any('sameHqAdd','AipSearchController@sameHqAdd');//相同图片检索库增加
Route::any('sameHqSearch','AipSearchController@sameHqSearch');//相同图片检索

Route::get('getHotNote','NoteController@getHotNote');
Route::get('getNoteInfoByNoteId/{noteId}','NoteController@getNoteInfoByNoteId');//根据笔记ID获取笔记详情

Route::get('wap/noteDetail/{noteId}','NoteController@noteDetail');//笔记详情
Route::get('getNoteByStoreId/{storeId}','NoteController@getNoteByStoreId');//笔记详情
Route::get('myFans','FansController@myFans');//粉丝数量

Route::post('focus','FansController@focus');//关注
Route::post('forwardNote','ForwardController@forwardNote');//转发
Route::get('getDemandListByUid/{uid}','DemandController@getDemandListByUid');//获取某个用户的需求列表
Route::get('getDemandDetail/{demandId}','DemandController@getDemandDetail');//获取某个需求详情
Route::get('getDemandList','DemandController@getDemandList');//获取需求列表

Route::get('getCreationList','CreationController@getCreationList');//获取作品列表
Route::get('getOtherCreationList','CreationController@getOtherCreationList');//获取别人的作品
Route::get('getChoiceCreationList/{demandId}','CreationController@getChoiceCreationList');//获取入围作品
Route::get('getCreationDetail/{creationId}','CreationController@getCreationDetail');//获取某个作品的详细信息

/**
 * 如果该接口是需要在登录的状态下才能获取的，请把路由写在checkLogin组里
 */
Route::group(['middleware'=>'checkLogin'],function(){
    //需求相关功能
    Route::post('addDemand','DemandController@addDemand');//发布需求
    Route::get('getMyDemandList','DemandController@getMyDemandList');//获取我的需求列表
    Route::post('addCreation','CreationController@addCreation');//上传作品
    Route::get('getMyCreationList','CreationController@getMyCreationList');//获取我的作品
    Route::get('getDemandCreationList/{demandId}','CreationController@getDemandCreationList');//获取某个需求的参赛作品
    Route::post('changeChoice','CreationController@changeChoice');//获取某个需求的参赛作品



    Route::get('logout','LoginController@logout');//退出登录
    /*****************AddressController**********************************/
    Route::get('addressList','AddressController@addressList');//获取我的收货地址
    Route::get('defaultAddress','AddressController@defaultAddress');//获取我的默认收货地址
    Route::post('addAddress','AddressController@addAddress');//添加收货地址
    Route::post('updateAddress','AddressController@updateAddress');//修改收货地址
    Route::post('setDefaultAddress/{id}','AddressController@setDefaultAddress');//修改默认收货地址
    Route::get('addressDetail','AddressController@addressDetail');//收货地址详情
    Route::post('deleteAddress/{id}','AddressController@deleteAddress');//删除收货地址

    /*****************UserController********************/
    Route::get('updateUserInfo','UserController@updateUserInfo');//更新我的个人信息
    Route::post('updatePhoto','UserController@updatePhoto');//修改我的头像
    Route::get('getMyUserInfo','UserController@getMyUserInfo');//获取我的个人信息

    /*********************分销**************************************/
    Route::post('addAgentGoods','AgentController@addAgentGoods');

    Route::post('upload','UploadController@upload');//文件上传

    /*********************NoteController笔记相关接口**************************************/
    Route::get('getMyNoteList','NoteController@getMyNoteList');//获取我的原创笔记列表
    Route::post('deleteNote','NoteController@deleteNote');//删除笔记
    Route::post('deleteNoteNotOnly','NoteController@deleteNoteNotOnly');//删除多个笔记
    Route::get('searchNote/{keyword}','NoteController@searchNote');//搜索笔记
    Route::get('getNoteListByStoreId','NoteController@getNoteListByStoreId');//根据店铺ID查询相应的笔记
    Route::post('replayComment','NoteController@replayComment');//笔记下回复某个人评论
    Route::post('likeNote','NoteController@likeNote');//笔记点赞
    Route::post('addNote','NoteController@addNote');//发布笔记
    Route::get('getMyCollectNote','CollectController@getMyCollectNote');//获取我收藏的笔记
    Route::get('getMyLikeNote','LikeController@getMyLikeNote');//获取我点赞的笔记
    Route::post('collectNote','CollectController@collectNote');//收藏笔记
    Route::get('getGoodsNoteList','NoteController@getGoodsNoteList');//获取某商品下笔记列表

    /*****************InformationController消息接口********************************/
    Route::post('pubSysMessage','InformationController@pubSysMessage');//管理员发布系统消息
    Route::get('getSysMessage','InformationController@getSysMessage');//系统消息列表
    Route::post('commentNote','InformationController@commentNote');//评论笔记
    Route::get('getCommentMessage','InformationController@getCommentMessage');//评论笔记消息列表
    Route::get('readSysMessage','InformationController@readSysMessage');//已读系统消息


    /*****************FansController关注，粉丝接口********************************/
    Route::post('focus','FansController@focus');//关注
    Route::post('cancelFocus','FansController@cancelFocus');//取消关注

    Route::get('judgeFocus','FansController@judgeFocus');//判断当前登录的用户是否关注过此用户
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
    Route::post('bindMobile/{openId}','StoreController@bindMobile');//绑定手机号
    Route::post('updateStore','StoreController@updateStore');//修改店铺
    Route::get('authStore','StoreController@authStore');//认证店铺
    Route::get('storeList','StoreController@storeList');//店铺列表
    Route::get('myStoreDetail','StoreController@myStoreDetail');//我的店铺详情
    Route::get('uploadAuth','StoreController@uploadAuth');//上传店铺认证图

    /*****************ShopController商店接口********************************/
    Route::post('createOneCategory','ShopController@createOneCategory');//新增商品一级分类
    Route::post('createSonCategory','ShopController@createSonCategory');//新增商品二级分类
    Route::post('addGoods','ShopController@addGoods');//增加商品
    Route::post('purchase','ShopController@purchase');//购买商品创建记录
    Route::get('storeGoodsList','ShopController@storeGoodsList');//所属店铺下的商品列表
    Route::post('addCar','ShopController@addCar');//增加商品购物车
    Route::get('delCar','ShopController@delCar');//删除我的购物车商品
    Route::get('myCarList','ShopController@myCarList');//我的购物车列表
    Route::get('myOrderList','ShopController@myOrderList');//我的购物车列表
    Route::post('createRecord','ShopController@createRecord');//新增浏览记录信息
    Route::get('browseCount','ShopController@browseCount');//浏览记录统计数量
    Route::get('orderList','ShopController@orderList');//我的订单列表



    /*****************CashController申请金额接口********************************/
    Route::post('applyCash','CashController@applyCash');//申请提现
    Route::get('checkApply','CashController@checkApply');//审核提现申请
});
/*****************ShopController商店接口********************************/
Route::get('otherStoreDetail','ShopController@otherStoreDetail');//别人的店铺详情
Route::get('getGoodsList','ShopController@getGoodsList');//获取分类下的所有商品列表
Route::get('getGoodsDetail','ShopController@getGoodsDetail');//商品详情
Route::get('relateGoodsList','ShopController@relateGoodsList');//随机取10条相关商品列表
Route::get('recommendGoodsList','ShopController@recommendGoodsList');//为你推荐随机取10条相关商品列表
Route::get('searchGoodsList','ShopController@searchGoodsList');//搜索商品
Route::get('searchList','ShopController@searchList');//搜索商品（不按照分类）
Route::get('getGoodsNote','ShopController@getGoodsNote');//商品下笔记列表



Route::get('getStoreListBySearch','StoreController@getStoreListBySearch');//获取相应角色的店铺列表

Route::get('test1','TestController@test1');//浏览记录统计数量

Route::get('getQiniuUploadToken','UploadController@getQiniuUploadToken');//获取七牛文件上传的token


/**************************分类获取***********************************/
Route::get('categoryList/{isShop}','CategoryController@categoryList');



/*****************ValidateCodeController********************************/
Route::get('getCodeImg','ValidateCodeController@getCodeImg');
Route::get('checkValidateCode/{code}','ValidateCodeController@checkValidateCode');



Route::get('getAllProvinces','AreasController@getAllProvinces');
Route::get('getCitiesByProvince/{provinceId}','AreasController@getCitiesByProvince');
Route::get('getAreasByCityId/{cityId}','AreasController@getAreasByCityId');


Route::get('getOtherUserInfo/{id}','UserController@getUserInfo');//获取某个用户的信息
Route::get('getOtherNoteList/{id}','NoteController@getOtherNoteList');//获取别人的原创笔记列表
Route::get('getOtherCollectNote/{id}','CollectController@getOtherCollectNote');//获取别人收藏的笔记
Route::get('getOtherLikeNote/{id}','LikeController@getOtherLikeNote');//获取别人点赞的笔记


Route::post('sendSms','SmsController@sendSms');//发送短信
Route::post('bindTel','SmsController@bindTel');//绑定手机号

Route::get('wx/pay','WxpayController@pay');//支付
Route::get('wx/test','WxpayController@test');//微信
Route::post('notify','WxpayController@notify');//支付回调

Route::get('wx/refund','WxpayController@weixinRefund');//支付
Route::post('wx/refundNotify','WxpayController@refundNotify');//支付回调

Route::get('wx/auth','WxAuthController@auth');//微信授权登录
Route::get('wx/ad','WxAuthController@getAddress');//获取微信共享地址
Route::get('wx/share','WxAuthController@share');//微信分享朋友圈
Route::get('wx/location','WxAuthController@getLocation');//微信分享朋友圈

Route::get('wap/factoryShow', 'FactoryController@fatoryList');

Route::post('note/reply','CommentController@noteReply');
Route::post('note/commentList','CommentController@getNoteCommentList');
Route::get('tt','CommentController@tt');

Route::get('active/detail/{active_id}','ActiveController@detail');
Route::post('active/reply','CommentController@activeReply');




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
Route::get('wap/index', function () {//首页
    return view('index');
});
Route::get('wap/mech', function () {//文创机构展示页
    return view('indexDetail/mechanism');
});

Route::get('wap/museumed', function () {//博物馆展示
    return view('indexDetail/museum');
});

Route::get('wap/design', function () {//设计展示
    return view('indexDetail/designerd');
});
//Route::get('wap/designSerch', function () {//设计搜索
//    return view('indexDetail/designerd/designerd_serch');
//});
Route::get('wap/designW', function () {//设计详情
    return view('indexDetail/designerd/designerd_works');
});
Route::get('wap/upDesign', function () {//设计上传作品
    return view('indexDetail/designerd/upDesignImg');
});
Route::get('wap/factoryJm', function () {//工厂二级
    return view('indexDetail/factory/factory_jm');
});

Route::get('wap/factoryclass', function () {//工厂分类
    return view('indexDetail/factory/factory_classify');
});
Route::get('wap/musefen', function () {//博物馆分类
    return view('indexDetail/museumDetail/museumfen');
});

Route::get('wap/museumOne', function () {//博物馆一级
    return view('indexDetail/museumOne');
});
Route::get('wap/musegoods', function () {//首页展示笔记的二级页面
    return view('indexDetail/museumDetail/museumGoods');
});

Route::get('wap/studyIndex', function () {//洞学首页
    return view('indexDetail/caveStudy/studyIndex');
});
Route::get('wap/activeList', function () {//需求列表页
    return view('indexDetail/active/activeList');
});
Route::get('wap/activeDetail', function () {//需求详情页
    return view('indexDetail/active/activeDetail');
});
Route::get('wap/musename', function () {//博物馆商品
    $arr = ['id'=>0];
    if(Cookie::has('info')){
        $arr = Cookie::get('info');
    }
    return view('indexDetail/museumDetail/museumName',$arr);
});

Route::get('wap/shop', function () {//商城首页
    return view('shop/shop',Cookie::get('info')?Cookie::get('info'):['id'=>0]);
});
Route::get('wap/shop_share', function () {//商品分销
    return view('shop/shop-share');
});
Route::get('wap/other_store', function () {//他人的店铺，进店逛逛
    return view('shop/other-store');
});
Route::get('wap/shop_detail', function () {//商品详情
    return view('shop/shop-details',Cookie::get('info')?Cookie::get('info'):['id'=>0]);
});

Route::group(['middleware'=>'checkLogin'],function(){
    Route::get('wap/shop_cart', function () {//购物车列表
        return view('shop/shop-cart');
    });
    Route::get('wap/shop_purchase', function () {//购买
        return view('shop/shop-purchase');
    });
});
Route::group(['middleware'=>'checkLogin'],function(){
    Route::get('wap/myActiveList', function () {//我的需求列表页
        return view('indexDetail/active/myActiveList');
    });
    Route::get('wap/personal', function () {//个人中心
        return view('personal/personal-center',Cookie::get('info'));
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
    Route::get('wap/follow_interest',function () {//关注页面
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

    Route::get('wap/myworksDetail', function () {//发布需求
        return view('personal/myworksDetail');
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
        return view('personal/pinglun-edit',Cookie::get('info'));
    });
    Route::get('wap/store_status', function () {//店铺状态提示
        return view('personal/store-status',Cookie::get('info'));
    });
    Route::get('wap/pinglun_list', function () {//评论列表
        return view('personal/pinglun-list');
    });
    Route::get('wap/register_store', function () {//店铺注册
        return view('personal/register-store',Cookie::get('info'));
    });
    Route::get('wap/recommend', function () {//推荐消息
        return view('personal/recommend');
    });
    Route::get('wap/store', function () {//店铺首页
        return view('personal/store',Cookie::get('info'));
    });
    Route::get('wap/store_setting', function () {//店铺设置
        return view('personal/store-setting',Cookie::get('info'));
    });
    Route::get('wap/upper_shelf', function () {//商品上架
        return view('personal/upper-shelf');
    });
    Route::get('wap/write_note', function () {//写笔记
        return view('personal/write-note');
    });
});









