<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// 首页
Route::get('/','HomeController@index');

// 注册
Route::get('register','UsersController@register');






// 后台
Route::get('/admin','AdminController@index');







// 测试
Route::get('/test',function(){

	return View::make('layouts.admin');
});