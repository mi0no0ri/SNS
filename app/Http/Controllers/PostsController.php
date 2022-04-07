<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Controllers\Auth;

class PostsController extends Controller
{
    
    public function index()
    {
        // $post = DB::table('users')->get();
        // return view('posts.index', ['']);
        // $user = Auth::user();
        //↓初期値
        return view('posts.index');

    }
    // public function index(Require $require)
    // {
    //     $user = Auth::user();

    // }
}
