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

// Получение всех товаров и товаров из корзины
Route::get('items', 'AllGoods@showGood');

// Работа с корзиной
Route::get('cart', 'CartController@showCart');
Route::post('cart', 'CartController@addtoCart');
Route::delete('cart', 'CartController@DeleteItem');

// Получие всех Addition
Route::get('additions', 'AllGoods@showAddition');

// Авторизация Пользователя
Route::get('login', 'LoginController@showLogin');
Route::post('login', 'LoginController@doLogin');

// Регистрация Пользователя
Route::get('sign', 'SignController@showSignin');
Route::post('sign', 'SignController@doSign');

// Главный route и вывод landing page
Route::get('/', function() { return View::make('home'); });
Route::get('/landing', function() { return View::make('landing'); });