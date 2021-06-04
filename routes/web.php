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



Route::get('aboutus',function(){
    return view('pages.aboutus');
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
Route::post('user/{user_id}/manage/category','UserController@manageCategory');
Route::delete('user/{user_id}/unfollow_category','UserController@unfollowCategory')->name('unfollow_cat');
Route::get('/user/{user_id}/pic','UserController@getProfilePic')->name('avatar');
Route::post('/user/{user_id}/follow','UserController@followUser')->name('follow');

//Feed
Route::get('authuserfeed', 'FeedController@show')->name('authuserfeed');
Route::get('home','FeedController@show')->name('home');
Route::get('search','FeedController@search')->name('search');


// Post 
Route::get('/post/{id}', 'PostController@show')->where(['id' => '[0-9]+']);
Route::delete('/post/{post_id}', 'PostController@delete')->where(['post_id' => '[0-9]+']);
Route::post('/post/{post_id}/report', 'PostController@report')->where(['post_id' => '[0-9]+'])->name('report_post');
Route::get('/post/{post_id}/save', 'PostController@save')->where(['post_id' => '[0-9]+'])->name('save_post');
Route::get('/post/{post_id}/edit', 'PostController@showEdit');
Route::put('/post/{post_id}', 'PostController@edit')->name('editpost');
Route::get('/post/new', 'PostController@showNewPost');
Route::post('/post/new', 'PostController@storeNewPost')->name('create_new_post');
Route::post('/post/{post_id}/vote', 'PostVoteController@storeNewPostVote')->name('post_vote');
Route::get('/post/{post_id}/pic','PostController@getPostPic')->name('previewpic');


//Search
Route::get('/searchUsers', 'UserController@searchUsers')->name('searchUsers');
Route::get('/searchPosts', 'FeedController@searchPosts')->name('searchPosts');
Route::get('/searchUserManagement', 'UserController@searchUserManagement');

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
Route::get('/admin/reports/posts/{post_id}/{comment_id}','AdminController@viewComment')->name('reported_comment');

Route::post('/admin/reports/posts/{post_id}', 'ReportController@deletePostAdmin')->name('delete_post_admin');
Route::post('/admin/reports/posts/{post_id}/{comment_id}', 'ReportController@deleteCommentAdmin')->name('delete_comment_admin');
Route::post('/admin/reports/{report_id}', 'ReportController@dismissReport')->name('dismiss');

Route::post('/admin/reports', 'AdminController@updateDashboard');

Route::post('/admin/undo/{report_id}', 'AdminController@undoAction')->name('undo_action');

Route::get('/admin/users','AdminController@showUsers')->name('users');
Route::get('/admin/users/{user_id}','AdminController@showUser');
Route::post('/admin/users/ban/{user_id}', 'ReportController@banUser')->name('ban');
Route::post('/admin/users/suspend/{user_id}', 'ReportController@suspendUser')->name('suspend');
Route::post('/admin/users/active/{user_id}', 'ReportController@activateUser')->name('active');

Route::get('/login/suspended', 'UserController@suspendedUser');
Route::get('/login/banned', 'UserController@bannedUser');

//---------------------------------------------------

/*Route::post('/post/{post_id}/vote', 'PostController@vote');
Route::delete('/post/{post_id}/vote', 'PostController@remove_vote');
Route::post('/post/{post_id}/report', 'PostController@report');
Route::post('/post/{post_id}/save', 'PostController@save');


// Search
Route::get('/search', 'SearchController@search_results')->name('search');*/
