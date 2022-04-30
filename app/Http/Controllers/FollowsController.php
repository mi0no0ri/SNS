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
            ->join('follows', 'posts.user_id', '=', 'follows.id')
            ->groupBy('posts.id')
            ->where('follows.follower_id', '=', Auth::id())
            ->where('follows.id', '<>', Auth::id())
            ->select('posts.id','users.username','posts.created_at','posts.post','posts.user_id','users.images')
            ->latest()->get('posts.id');

        $follows = DB::table('follows')
            ->join('users', 'follows.id', '=', 'users.id')
            ->where('follows.follower_id','=',Auth::id())
            ->where('follows.id', '<>', Auth::id())
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
            ->join('follows', 'posts.user_id', '=', 'follows.id')
            ->groupBy('posts.id')
            ->where('follows.follow_id', '=', Auth::id())
            ->where('follows.id', '<>', Auth::id())
            ->select('posts.id','users.username','posts.created_at','posts.post','posts.user_id','users.images')
            ->latest()->get('posts.id');

        $followers = DB::table('follows')
            ->join('users','follows.id','=','users.id')
            ->where('follows.follow_id','=',Auth::id())
            ->where('follows.id','<>',Auth::id())
            ->select('users.id','users.username','users.bio','users.images')
            ->get();


        return view('follows.followerList',[
            'lists' => $lists,
            'followers' => $followers
        ]);
    }
    public function count()
    {
        $follows = DB::table('follows')
            ->where('follower_id', '=', Auth::id())
            ->count();

        return view('layouts.login',['follows' => $follows]);
    }
}
