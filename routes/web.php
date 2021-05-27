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
Route::get('home',function(){
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


//---------------------------------------------------

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register')->name('register');

// Profile
Route::get('/user/{user_id}', 'UserController@show')->name('profile');
Route::delete('/settings', 'UserController@delete');
Route::get('/settings', 'UserController@showEditProfile');
Route::put('/settings', 'UserController@editProfile'); 
Route::post('user/{user_id}/follow_category','UserController@followCategory')->name('follow_cat');
Route::delete('user/{user_id}/unfollow_category','UserController@unfollowCategory')->name('unfollow_cat');
Route::get('/user/{user_id}/pic','UserController@getProfilePic')->name('avatar');

//Feed
Route::get('authuserfeed', 'FeedController@show')->name('authuserfeed');
Route::get('home','FeedController@show')->name('home');
Route::get('search','FeedController@search')->name('search');


// Post 
Route::get('/post/{id}', 'PostController@show')->where(['id' => '[0-9]+']);
Route::delete('/post/{post_id}', 'PostController@delete')->where(['post_id' => '[0-9]+']);
Route::post('/post/{post_id}/report', 'PostController@report')->where(['post_id' => '[0-9]+'])->name('report_post');
Route::get('/post/{post_id}/edit', 'PostController@showEdit');
Route::put('/post/{post_id}', 'PostController@edit')->name('editpost');
Route::get('/newpost', 'PostController@showNewPost');
Route::post('/newpost', 'PostController@storeNewPost') -> name('create_new_post');
 



Route::get('/searchUsers', 'UserController@searchUsers')->name('searchUsers');
Route::get('/searchPosts', 'FeedController@searchPosts')->name('searchPosts');

//Comment
Route::post('/post/{post_id}/comment', 'CommentController@newComment')->name('comment');
Route::post('/comment/{comment_id}/reply', 'CommentController@replyComment')->name('reply')->where(['comment_id' => '[0-9]+']);
Route::delete('/comment/{comment_id}', 'CommentController@deleteComment')->name('delete_comment');
Route::put('/comment/{comment_id}', 'CommentController@editComment')->name('edit_comment');
Route::post('/comment/{comment_id}/report', 'CommentController@reportComment')->name('report_comment')->where(['comment_id' => '[0-9]+']);
//Route::get('/get_comment/{comment_id}','CommentController@getComment')->where(['comment_id' => '[0-9]+']);

//Admin
Route::get('/admin/reports','AdminController@show')->name('reports');
Route::get('/admin/reports/posts/{post_id}','AdminController@viewPost')->name('reported_post');
//---------------------------------------------------

/*Route::post('/post/{post_id}/vote', 'PostController@vote');
Route::delete('/post/{post_id}/vote', 'PostController@remove_vote');
Route::post('/post/{post_id}/report', 'PostController@report');
Route::post('/post/{post_id}/save', 'PostController@save');


// Search
Route::get('/search', 'SearchController@search_results')->name('search');*/
