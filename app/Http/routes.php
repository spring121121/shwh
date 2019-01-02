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
Route::get('login','LoginController@login');


/*****************RegisterController********************************/
Route::post('register','RegisterController@register');







/*****************ValidateCodeController********************************/
Route::get('getCodeImg','ValidateCodeController@getCodeImg');
Route::get('checkValidateCode','ValidateCodeController@checkValidateCode');



Route::get('getAllProvinces','AreasController@getAllProvinces');
Route::get('getCitiesByProvince/{provinceId}','AreasController@getCitiesByProvince');
Route::get('getAreasByCityId/{cityId}','AreasController@getAllProvinces');
Route::post('upload','UploadController@upload');
Route::get('getMyNoteList','NoteController@getMyNoteList');




/*****************InformationController********************************/
Route::post('pubSysMessage','InformationController@pubSysMessage');
Route::get('getSysMessage','InformationController@getSysMessage');
Route::post('commentNote','InformationController@commentNote');
Route::get('getCommentMessage','InformationController@getCommentMessage');







