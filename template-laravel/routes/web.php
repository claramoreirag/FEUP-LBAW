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
Route::get('/','FeedController@show')->name('homepage');


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

//---------------------------------------------------

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::get('/ownprofile/{user_id}', 'UserController@show');
//Route::get('/ownprofile/{user_id}', 'Auth\OwnProfileController@editProfile');
//Route::get('/ownprofile/{user_id}', 'Auth\OwnProfileController@createPost');
//Route::get('/ownprofile/{user_id}', 'Auth\OwnProfileController@switchPosts');

Route::get('/otherprofile/{user_id}', 'Auth\OtherProfileController@follow');
Route::get('/otherprofile/{user_id}', 'Auth\OtherProfileController@switchPosts');

// Search
Route::get('/search', 'SearchController@search_results')->name('search');


Route::get('/newpost', 'PostController@create')->name('new_post');
Route::post('/newpost', 'PostController@store');
 
Route::get('authuserfeed', 'FeedController@show')->name('authuserfeed');
Route::get('homepage','FeedController@show')->name('homepage');

//---------------------------------------------------


// Post 
Route::get('/posts/{id}', 'PostController@show')->where(['id' => '[0-9]+']);
Route::delete('/post/{post_id}', 'PostController@delete');
Route::get('/post/{post_id}/edit', 'PostController@showEdit');
Route::put('/post/{post_id}', 'PostController@edit');
Route::post('/post/{post_id}/vote', 'PostController@vote');
Route::delete('/post/{post_id}/vote', 'PostController@remove_vote');
Route::post('/post/{post_id}/report', 'PostController@report');
Route::post('/post/{post_id}/save', 'PostController@save');

//Comment
Route::post('/comment', 'CommentController@newComment');
Route::post('/reply', 'CommentController@replyComment');
Route::delete('/comment/{comment_id}', 'CommentController@deleteComment');
Route::put('/comment/{comment_id}', 'CommentController@editComment');

