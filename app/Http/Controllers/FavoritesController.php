<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use Auth;

class FavoritesController extends Controller
{
    // favoriteList
    public function favoriteList($user)
    {
        $favorites = DB::table('favorites')
            ->join('users', 'favorites.user_id', '=', 'users.id')
            ->join('posts', 'favorites.post_id', '=', 'posts.id')
            ->where('favorites.user_id', $user)
            ->get();
        return view('users.favorite', compact('favorites'));
    }
}
