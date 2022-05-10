<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\Authenticate;

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

Route::get('/', function () {
    return view('/login');
});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::resource('users', 'UsersController');
});

//ログアウト中のページ
Route::group(['middleware' => 'auth'],function(){

Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');
});

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register')->name('register');

Route::get('/added', 'Auth\RegisterController@added')->name('added');


//ログイン中のページ
Route::get('/top','PostsController@index');

// profile
Route::group(['middleware' => 'auth'],function(){

Route::get('/profile','UsersController@index')->name('profile');
Route::put('/profile','UsersController@profileUpdate')->name('profileUpdate');
Route::put('/password_change','UsersController@passwordUpdate')->name('password_edit');
});
Route::get('/userProfile/{id}','UsersController@otherProfile')->name('user_profile');

//ログアウトのページ
Route::get('/logout','Auth\LoginController@logout');
Route::post('/logout','Auth\LoginController@logout');

//バリデーション
Route::get('/login','Authenticate@redirectTo')
    ->middleware(Authenticate::class);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ユーザー検索
Route::get('/search','UsersController@search');
Route::post('/result','UsersController@search');

// 投稿
Route::get('/post/create','PostsController@create');
Route::post('/post/create','PostsController@create');

//投稿の編集
Route::get('/post/{id}/update-form', 'PostsController@updateForm');
Route::post('/post/update/{id}','PostsController@update')->name('update');

// delete
Route::get('post/{id}/delete','PostsController@delete');

// followList
Route::get('/followList', 'FollowsController@followList');
Route::get('/follow', 'UsersController@follow');

// followerList
Route::get('/follower','FollowsController@followerList');

Route::group(['middleware' => 'auth'],function(){
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'update', 'updateForm']]);

    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
});