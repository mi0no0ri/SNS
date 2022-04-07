<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use APp\Http\Middleware\Authenticate;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@index');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

//実装確認用
Route::get('/logout','Auth\LoginController@logout');

//ログアウトのページ
Route::get('/logout','Auth\LoginController@loggedOut');
Route::post('/logout','Auth\LoginController@loggedOut');

//バリデーション
Route::get('/login','Authenticate@redirectTo')
    ->middleware(Authenticate::class);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ユーザー検索
Route::get('/search','UsersController@search');