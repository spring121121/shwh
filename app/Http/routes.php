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

Route::get('/', function () {
    return view('welcome');
});


/*****************UserController********************/
Route::get('showProfile','UserController@showProfile');
Route::get('testRequest/{id}','TestController@testRequest');
Route::get('testResponse','TestController@testResponse');
Route::post('userAdd','UserController@userAdd');



/*****************AddressController**********************************/
Route::get('addressList','AddressController@addressList');
Route::post('addAddress','AddressController@addAddress');
Route::post('updateAddress','AddressController@updateAddress');


/*****************LoginController***********************************/
Route::post('login','LoginController@login');


/*****************RegisterController********************************/
Route::post('register','RegisterController@register');

/*********************分销**************************************/
Route::post('addAgentGoods','AgentController@addAgentGoods');


/**************************分类获取***********************************/
Route::get('categoryList/{isShop}','CategoryController@categoryList');



/*****************ValidateCodeController********************************/
Route::get('getCodeImg','ValidateCodeController@getCodeImg');
Route::get('checkValidateCode/{code}','ValidateCodeController@checkValidateCode');



Route::get('getAllProvinces','AreasController@getAllProvinces');
Route::get('getCitiesByProvince/{provinceId}','AreasController@getCitiesByProvince');
Route::get('getAreasByCityId/{cityId}','AreasController@getAllProvinces');


Route::post('upload','UploadController@upload');


Route::get('getMyNoteList','NoteController@getMyNoteList');

Route::get('getMyCollectNote','CollectController@getMyCollectNote');
Route::post('deleteNote','NoteController@deleteNote');
Route::post('deleteNoteNotOnly','NoteController@deleteNoteNotOnly');
Route::get('searchNote/{keyword}','NoteController@searchNote');
Route::get('getNoteListByStoreId','NoteController@getNoteListByStoreId');


/************************店铺*********************************/
Route::get('getMyCollectNote','CollectController@getMyCollectNote');



/*****************InformationController消息接口********************************/
Route::post('pubSysMessage','InformationController@pubSysMessage');//管理员发布系统消息
Route::get('getSysMessage','InformationController@getSysMessage');//系统消息列表
Route::post('commentNote','InformationController@commentNote');//评论笔记
Route::get('getCommentMessage','InformationController@getCommentMessage');//笔记列表
Route::get('readSysMessage','InformationController@readSysMessage');//已读系统消息

/*****************FansController关注，粉丝接口********************************/
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
Route::get('wap/follow_interest', function () {//回复评论
    return view('personal/follow-interest');
});






