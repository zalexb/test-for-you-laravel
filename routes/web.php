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

Route::get('/',['as'=>'index','uses'=>'PostsController@index']);

Route::get('/single/{id}',['as'=>'single','uses'=>'PostsController@single']);

Route::match(['get','post'],'/edit',['as'=>'create_post','uses'=>'PostsController@create']);

Route::match(['get','put'],'/edit/{id}',['as'=>'edit_post','uses'=>'PostsController@edit']);

Route::delete('/delete/{id}',['as'=>'delete_post','uses'=>'PostsController@delete']);



Route::post('/user/login',['as'=>'login','uses'=>'UsersController@login']);

Route::get('/user/logout',['as'=>'logout','uses'=>'UsersController@logout']);


