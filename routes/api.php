<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user/register', 'ApiController@user_registration');
Route::post('/user/login', 'ApiController@user_login');
Route::post('/user/logout', 'ApiController@logout');
Route::post('/user/forgot-password', 'ApiController@forgot_password');
Route::post('/user/reset-password', 'ApiController@reset_password');
Route::post('/user/profile', 'ApiController@profile');

Route::post('/trainer/register', 'ApiController@trainer_registration');
Route::post('trainer/login', 'ApiController@trainer_login');
Route::post('trainer/logout', 'ApiController@trainer_logout');
Route::post('trainer/profile','ApiController@trainer_profile');