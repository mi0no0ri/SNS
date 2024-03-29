<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;
use Auth;

class FollowsController extends Controller
{
    public function followList(User $user)
    {
        $lists = DB::table('posts')
            ->join('users','posts.user_id' , '=' , 'users.id')
            ->join('follows', 'posts.user_id', '=', 'follows.follow_id')
            ->groupBy('posts.id')
            ->where('follows.follower_id', '=', Auth::id())
            ->select('posts.id','posts.user_id','posts.post','posts.created_at','users.username','users.images')
            ->latest()
            ->get('posts.id');

        $follows = DB::table('follows')
            ->join('users', 'follows.follow_id', '=', 'users.id')
            ->where('follows.follower_id','=', Auth::id())
            ->select('users.id','users.username','users.bio','users.images')
            ->get();

        return view('follows.followList', [
            'lists' => $lists,
            "follows" => $follows
        ]);
    }
    public function followerList(User $user)
    {
        $lists = DB::table('posts')
            ->join('users','posts.user_id' , '=' , 'users.id')
            ->join('follows', 'posts.user_id', '=', 'follows.follower_id')
            ->groupBy('posts.id')
            ->where('follows.follow_id', '=', Auth::id())
            ->select('posts.id','posts.user_id','posts.post','posts.created_at','users.username','users.images')
            ->latest()
            ->get('posts.id');

        $followers = DB::table('follows')
            ->join('users','follows.follower_id','=','users.id')
            ->where('follows.follow_id','=',Auth::id())
            ->select('users.id','users.username','users.bio','users.images')
            ->get();


        return view('follows.followerList',[
            'lists' => $lists,
            'followers' => $followers
        ]);
    }
}
