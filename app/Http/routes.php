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


/*****************LoginController***********************************/
Route::get('login','LoginController@login');


/*****************RegisterController********************************/

/*****************ValidateCodeController********************************/
Route::get('getCodeImg','ValidateCodeController@getCodeImg');
Route::get('checkValidateCode','ValidateCodeController@checkValidateCode');




