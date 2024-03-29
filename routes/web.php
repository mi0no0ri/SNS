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

Auth::routes();

// user認証不要
Route::get('/', function () {
    return redirect('/login');
});

// userログイン後
Route::group(['middleware' => 'auth:user'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    // お知らせ一覧
    Route::get('notice', 'UsersController@notice')->name('notice');
    // よくある質問一覧
    Route::get('question', 'UsersController@question')->name('questions');
});

// admin認証不要
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', function () {
        return redirect('/admin/home');
     });
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
    //  新規登録
    Route::get('register', 'Admin\RegisterController@showRegisterForm')->name('admin.register');
    Route::post('register', 'Admin\RegisterController@register');
    //  新規登録後画面遷移
    Route::get('/added', 'Admin\RegisterController@added')->name('admin.added');
});

// adminログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
    // お知らせ
    Route::get('create_notice', 'Admin\NoticiesController@notice')->name('admin.notice');
    // お知らせ投稿
    Route::post('create_notice', 'Admin\NoticiesController@create_notice')->name('admin.create_notice');
    // お知らせ一覧
    Route::get('notice_list', 'Admin\NoticiesController@notice_list')->name('admin.notice_list');
    // お知らせ編集
    Route::get('notice_edit/{id}', 'Admin\NoticiesController@notice_editForm')->name('admin.notice_editForm');
    Route::post('notice_edit', 'Admin\NoticiesController@edit_notice')->name('admin.edit_notice');
    // お知らせ削除
    Route::delete('notice_list/{id}', 'Admin\NoticiesController@delete_notice')->name('admin.delete_notice');
    // よくある質問
    Route::get('question', 'Admin\QuestionsController@question')->name('admin.question');
    // よくある質問作成
    Route::post('question', 'Admin\QuestionsController@create_question')->name('admin.create_question');
    // よくある質問一覧
    Route::get('question_list', 'Admin\QuestionsController@question_list')->name('admin.question_list');
    // よくある質問編集
    Route::get('question_edit/{id}', 'Admin\QuestionsController@question_editForm')->name('admin.question_editForm');
    Route::post('question_edit', 'Admin\QuestionsController@edit_question')->name('admin.edit_question');
    // よくある質問削除
    Route::delete('question_delete/{id}', 'Admin\QuestionsController@delete_question')->name('admin.delete_question');
});







//ログアウト中のページ
Route::group(['middleware' => 'auth:user'],function(){

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
Route::post('/post/update','PostsController@update')->name('update');
// delete
Route::get('post/{id}/delete','PostsController@delete');

// followList
Route::get('/followList', 'FollowsController@followList');
Route::get('/follow', 'UsersController@follow');
// followerList
Route::get('/follower','FollowsController@followerList');

// favorite
Route::post('top/favorite/{post}', 'UsersController@favorite')->name('favorite');
Route::delete('top/favorite/{post}', 'UsersController@unfavorite')->name('unfavorite');
// favoriteList
Route::get('favorite/{user}','FavoritesController@favoriteList')->name('favorite_list');

// block
Route::post('userProfile/block/{user}', 'UsersController@block')->name('block');
// unblock
Route::delete('userProfile/block/{user}', 'UsersController@unblock')->name('unblock');
// blockList
Route::get('block_list', 'BlocksController@block')->name('blockList');

Route::group(['middleware' => 'auth'],function(){
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'update', 'updateForm']]);

    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
});
