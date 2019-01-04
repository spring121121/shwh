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







/*****************ValidateCodeController********************************/
Route::get('getCodeImg','ValidateCodeController@getCodeImg');
Route::get('checkValidateCode/{code}','ValidateCodeController@checkValidateCode');



Route::get('getAllProvinces','AreasController@getAllProvinces');
Route::get('getCitiesByProvince/{provinceId}','AreasController@getCitiesByProvince');
Route::get('getAreasByCityId/{cityId}','AreasController@getAllProvinces');


Route::post('upload','UploadController@upload');


Route::get('getMyNoteList','NoteController@getMyNoteList');

Route::get('getMyCollectNote','CollectController@getMyCollectNote');
Route::get('deleteNote','NoteController@deleteNote');


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

/************************前端路由*********************************/
Route::get('login', function () {
    return view('personal/login');
});
Route::get('register', function () {
    return view('personal/register');
});






