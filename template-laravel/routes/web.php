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
// Home
Route::get('/', function(){
    return view('pages.homepage');
});


//Homepage
Route::get('homepage',function(){
    return view('pages.homepage');
});

Route::get('aboutus',function(){
    return view('pages.aboutus');
});

Route::get('fullpost',function(){
    return view('pages.fullpost');
});

Route::get('fullpostadmin',function(){
    return view('pages.fullpostadmin');
});

Route::get('admindashboard',function(){
    return view('pages.admindashboard');
});

Route::get('authuserfeed',function(){
    return view('pages.authuserfeed');
});
Route::get('editpost',function(){
    return view('pages.editpost');
});

Route::get('ownprofile',function(){
    return view('pages.ownprofile');
});

Route::get('newpost',function(){
    return view('pages.newpost');
});

Route::get('otherprofile',function(){
    return view('pages.otherprofile');
});

Route::get('usermanager',function(){
    return view('pages.usermanager');
});


// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
