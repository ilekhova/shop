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
Route::get('/', 'AllGoods@showGood');
Route::get('login', array('uses' => 'LoginController@showLogin'));
Route::post('login', array('uses' => 'LoginController@doLogin'));
Route::get('sign', array('uses' => 'SignController@showSignin'));
Route::post('sign', array('uses' => 'SignController@doSign'));
//Route::get('logout', array('uses' => 'LoginController@doLogout'));