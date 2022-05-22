<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use Validator;
use App\Http\Controller\Board;

class PostsController extends Controller
{

    public function index()
    {
        $lists = DB::table('posts')
            ->join('users','posts.user_id' , '=' , 'users.id')
            ->leftJoin('follows', 'posts.user_id', '=', 'follows.follow_id')
            ->groupBy('posts.id')
            ->where('follows.follower_id', '=', Auth::id())
            ->orWhere('posts.user_id', '=', Auth::id())
            ->select('posts.id','users.username','posts.created_at','posts.post','posts.user_id','users.images')
            ->latest()
            ->get('posts.id');
        return view('posts.index',['lists'=>$lists]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'post' => ['max:150'],
        ],[
            'post.max' => '投稿は150文字以内にしてください。'
        ]);
        $post = $request->input('newPost');
        DB::table('posts')->insert([
            'post' => $post,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect('/top');
    }

    public function followList()
    {
        return view('followList');
    }

    public function updateForm($id)
    {
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.updateForm',compact('post'));
    }

    public function update(Request $request)
    {
        $id = $request
            ->input('id');
        $up_post = $request
            ->input('upPost');
        DB::table('posts')
            ->where('id',$id)
            ->update([
                'post' => $up_post,
                'updated_at' => now()
            ]);
        return redirect('/top');
    }

    public function delete($id)
    {
        DB::table('posts')
            ->where('id',$id)
            ->delete();
        return redirect('/top');
    }

}
