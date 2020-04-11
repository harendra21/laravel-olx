<?php

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

Route::GET('/', 'HomeCtrl@index');


Route::GET('/p/{url}', 'HomeCtrl@view_product');

Route::GET('get-comments', 'HomeCtrl@get_comments');
Route::POST('add-comment', 'HomeCtrl@add_comment');



Route::POST('video-upload', 'VideoCtrl@video_upload');
Route::GET('convert', 'VideoCtrl@convert');


// auth routes
Route::GET('login', 'AuthCtrl@login');
Route::GET('register', 'AuthCtrl@register');
Route::POST('do-register', 'AuthCtrl@do_register');
Route::POST('do-login', 'AuthCtrl@do_login');
Route::GET('logout', 'AuthCtrl@logout');

// my product routes
Route::GET('my-products','ProductCtrl@my_products')->middleware(['auth']);
Route::GET('add-product','ProductCtrl@add_product')->middleware(['auth']);
Route::POST('do-add-product','ProductCtrl@do_add_product')->middleware(['auth']);

Route::GET('delete-product/{id}','ProductCtrl@delete_product')->middleware(['auth']);

