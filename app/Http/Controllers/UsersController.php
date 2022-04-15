<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Post;
use App\Models\Follower;

class UsersController extends Controller
{
    public function profile(){
        return view('users.profile');
    }

    // public function search(Request $request){
    //     $list = User::where('username',$request->input)->get();
    //     $param = ['input' => $request->input, 'list' => $list];
    //     return view('users.search', $param);
    // }
    public function search(Request $request){
        $keyword = $request->input('keyword');

        $query = DB::table('users');

        if(!empty($keyword)) {
            $query->where('username','LIKE',"%{$keyword}%");
        }
        $list = $query->get();

    return view('users.search',['list'=>$list]);
    }

    // follow
    public function follow(User $user)
    {
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following){
            $follower->follow($user->id);
            return back();
        }
    }
    // unfollow
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            $follower->unfollow($user->id);
            return back();
        }
    }
}
