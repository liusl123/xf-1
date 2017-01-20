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
//后台主页
Route::get('/admin', 'AdminController@index');

// 用户模块
Route::controller('/admin/user','UserController');










// sql语句记录
// Event::listen('illuminate.query',function($query){
//      var_dump($query);
//  });