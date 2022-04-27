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
        $follow_users = $user->getFollowUsers(auth()->user()->id)->where('id', '<>', Auth::id());
        $id = Auth::id();

        $lists = DB::table('posts')
            ->leftJoin('users','posts.user_id' , '=' , 'users.id')
            ->leftJoin('follows', 'users.id', '=', 'follows.follower_id')
            ->groupBy('posts.id')
            ->where('users.id', '<>', Auth::id())
            ->select('posts.id','users.username','posts.created_at','posts.post','posts.user_id','users.images')
            ->latest()->get('posts.id');

        return view('follows.followList', [
            'follow_users' => $follow_users,
            'lists' => $lists
        ]);
    }
    public function followerList(User $user)
    {
        $follower_users = $user->getFollowerUsers(auth()->user()->id)->where('id', '<>', Auth::id());

        // draft
        $lists = DB::table('posts')
            ->leftJoin('users','posts.user_id' , '=' , 'users.id')
            ->leftJoin('follows', 'users.id', '=', 'follows.follow_id')
            ->groupBy('posts.id')
            ->where('users.id', '<>', Auth::id())
            ->select('posts.id','users.username','posts.created_at','posts.post','posts.user_id','users.images')
            ->latest()->get('posts.id');


        return view('follows.followerList',[
            'follower_users' => $follower_users,
            'lists' => $lists
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
