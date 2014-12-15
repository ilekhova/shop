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
/*Route::get('/', 'AllGoods@showGood');
*/
Route::get('cart', array('uses' => 'CartController@showCart'));
Route::get('login', array('uses' => 'LoginController@showLogin'));//->before('auth.basic');
Route::post('login', array('uses' => 'LoginController@doLogin'));
Route::get('sign', array('uses' => 'SignController@showSignin'));
Route::post('sign', array('uses' => 'SignController@doSign'));
  Route::get('/logout', function()
    {
     
   	Auth::logout();
    Session::flush();
        return Redirect::to('/');
    })->before('auth.basic');

Route::resource('items', 'ItemsController');
  /*
Route::any("/logout", [
  
  "uses" => "UserController@logout"
])->before('auth.basic');*/

Route::get('/', function() { return View::make('home'); });
Route::get('/landing', function() { return View::make('landing'); });

