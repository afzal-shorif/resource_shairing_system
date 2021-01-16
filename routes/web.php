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

Route::get('/','App\Http\Controllers\Authorization@home');

Route::get('/home', 'App\Http\Controllers\Home@index')->middleware('check_login');
Route::get('/home/{class}', 'App\Http\Controllers\Home@index')->middleware('check_login');
Route::get('/download/{filename}/{resource_id}','App\Http\Controllers\Home@download')->middleware('check_login');
Route::get('/add_to_cart/{page}/{file_id}','App\Http\Controllers\Home@add_to_cart')->middleware('check_login');
Route::get('/cart','App\Http\Controllers\Home@cart')->middleware('check_login');
Route::get('/remove_to_cart/{file_id}','App\Http\Controllers\Home@remove_to_cart')->middleware('check_login');
Route::get('/logout','App\Http\Controllers\Home@logout')->middleware('check_login');
Route::get('/cart_confirm','App\Http\Controllers\Home@cart_confirm')->middleware('check_login');
/**
 * Resource
*/
Route::get('/my_resource/{class}','App\Http\Controllers\Resource@index')->middleware('check_login');
Route::get('/create_resource/','App\Http\Controllers\Resource@create')->middleware('check_login');
Route::post('/upload_book','App\Http\Controllers\Resource@upload_book')->middleware('check_login');
Route::post('/upload_slide','App\Http\Controllers\Resource@upload_slide')->middleware('check_login');
Route::post('/upload_link','App\Http\Controllers\Resource@upload_link')->middleware('check_login');
Route::get('/update_visibility/','App\Http\Controllers\Resource@update_visibility')->middleware('check_login');
Route::get('/update_resource/','App\Http\Controllers\Resource@update_resource')->middleware('check_login');
Route::get('/delete_resource/','App\Http\Controllers\Resource@delete_resource')->middleware('check_login');
Route::post('/update/','App\Http\Controllers\Resource@update')->middleware('check_login');


/**
 * Login
*/
Route::get('/login/{user_type}', 'App\Http\Controllers\Authorization@index');
Route::get('/login', 'App\Http\Controllers\Authorization@index');
/**
 * register
 */
Route::get('/register', 'App\Http\Controllers\Authorization@register');
Route::get('/register/{user_type}', 'App\Http\Controllers\Authorization@register');


Route::post('/check_login', 'App\Http\Controllers\Authorization@check_login');
Route::post('/register_teacher', 'App\Http\Controllers\Authorization@register_teacher');
Route::post('/register_student', 'App\Http\Controllers\Authorization@register_student');

Route::get('/user_select', 'App\Http\Controllers\Authorization@user_select');

/**
 * search
*/
Route::get('/search', 'App\Http\Controllers\Resource@search')->middleware('check_login');

/**
* profile
 */
Route::get('/profile', 'App\Http\Controllers\Home@profile')->middleware('check_login');

Route::post('/update_firstname', 'App\Http\Controllers\Home@update_firstname')->middleware('check_login');
Route::post('/update_lastname', 'App\Http\Controllers\Home@update_lastname')->middleware('check_login');
Route::post('/update_email', 'App\Http\Controllers\Home@update_email')->middleware('check_login');
Route::post('/update_phone', 'App\Http\Controllers\Home@update_phone')->middleware('check_login');
Route::post('/update_password', 'App\Http\Controllers\Home@update_password')->middleware('check_login');
Route::post('/update_profile_picture', 'App\Http\Controllers\Home@update_picture')->middleware('check_login');

/**
 * admin
 */
Route::get('/dashboard', 'App\Http\Controllers\Admin@index')->middleware('admin');
Route::get('/registered_student', 'App\Http\Controllers\Admin@registered_student')->middleware('admin');
Route::get('/registered_teacher', 'App\Http\Controllers\Admin@registered_teacher')->middleware('admin');
Route::get('/pending_student', 'App\Http\Controllers\Admin@pending_student')->middleware('admin');
Route::get('/pending_teacher', 'App\Http\Controllers\Admin@pending_teacher')->middleware('admin');
Route::get('/active_user/{type}/{id}','App\Http\Controllers\Admin@active_user')->middleware('admin');
Route::get('/suspend_user/{type}/{id}','App\Http\Controllers\Admin@suspend_user')->middleware('admin');
Route::get('/user_details','App\Http\Controllers\Admin@user_details')->middleware('admin');



