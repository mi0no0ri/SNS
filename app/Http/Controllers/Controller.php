<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Follow;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(){
    $this->middleware( function ($request, $next)
{
//ログインユーザー名
$username = Auth::user();
//フォロワーのカウント
$countFollower = Follow::where('follow', '=', Auth::id())
->count();
//フォローのカウント
$countFollow = Follow::where('follower', '=', Auth::id())
->count();

// お試し
$info = Auth::user();



//全ビューで共通で使えるよう渡してあげる。むっちゃ素敵。
View::share('username', $username['username']);
View::share('userimage', $username['images']);
View::share('countFollower', $countFollower);
View::share('countFollow', $countFollow);
View::share('info', $info);




return $next($request);
});
}









}
