<?php
use App\Mail\NewUserWelcomeMail;
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


Auth::routes();

Route::get('/email', function() {
    return new NewUserWelcomeMail();
});

/**
 * Posts Routes
 */
// Route::get('/home', 'ProfilesController@index')->name('home');
Route::get('/', 'PostsController@index');
Route::get('/post/create', 'PostsController@create')->name('post.create');
Route::post('/post', 'PostsController@store')->name('post.store');
Route::get('/post/{post}', 'PostsController@show')->name('post.show');

/**
 * Profile Routes
 */
Route::get('/profile/{user}-{slug}', 'ProfilesController@index')->name('profile.index');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
Route::get('/profile/{user}-my-profile', 'ProfilesController@myProfile')->name('profile.myProfile');


Route::post('/follow/{user}', 'FollowsController@store');
Route::get('/profile/{user}/followers', 'FollowsController@showFollowers')->name('showFollowers');
Route::get('/profile/{user}/following', 'FollowsController@showFollowing')->name('showFollowing');

/**
 * Comment Routes
 */
Route::get('/post/{post}/comment/create', 'CommentController@create')->name('comments.create');
Route::post('/post/{post}/comment', 'CommentController@store')->name('comments.store');
Route::get('/post/{post}/comment/{comment}/edit', 'CommentController@edit')->name('comments.edit');
Route::patch('/post/{post}/comment/{comment}', 'CommentController@update')->name('comments.update');
Route::delete('/post/{post}/comment/{comment}', 'CommentController@destroy')->name('comments.destroy');


/**
 * Like Routes
 */
Route::post('/post/{post}/like', 'LikeController@store');
Route::post('/post/{post}/like/count', 'LikeController@countLikes');

