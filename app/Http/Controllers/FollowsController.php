<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowsController extends Controller
{
    public function followList(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('follows.followList', [
            'all_users' =>$all_users
        ]);
    }
    public function followerList()
    {
        return view('follows.followerList');
    }
}
