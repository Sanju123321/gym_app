<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get','post'],'/','AuthController@login');
Route::match(['get','post'],'/admin/login','AuthController@login');
Route::match(['get','post'],'/forgot-password','AuthController@forgot_password');
Route::match(['get','post'],'/set-password/{security_code}/{user_id}','AuthController@set_password');
Route::match(['get','post'],'/logout','AuthController@logout');

Route::group(['prefix'=>'admin','middleware'=>'CheckAdminAuth'],function()
{
	//------Dahboard---------------------------------------------------------------------------
	Route::get('/home','Admin\AdminController@index');

	//------Dahboard---------------------------------------------------------------------------


	//------Manage User ---------------------------------------------------------------------------
	Route::get('/user','Admin\UsersController@index');
	Route::any('/user/add','Admin\UsersController@add');
	Route::any('/user/edit/{id}','Admin\UsersController@add');
	Route::any('/user/delete/{id}','Admin\UsersController@delete');

	//------Manage User ---------------------------------------------------------------------------

    //------Manage trainer ---------------------------------------------------------------------------
    Route::get('/trainer','Admin\TrainerController@index');
    Route::any('/trainer/add','Admin\TrainerController@add');
    Route::any('/trainer/edit/{id}','Admin\TrainerController@add');
    Route::any('/trainer/delete/{id}','Admin\TrainerController@delete');

    //------Manage trainer ---------------------------------------------------------------------------

});
