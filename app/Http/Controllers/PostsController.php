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
        User::latest()->get();

        $list = DB::table('posts')
        ->leftJoin('users','posts.user_id' , '=' , 'users.id')
        ->select('posts.id','users.username','posts.created_at','posts.post')
        ->get();
        return view('posts.index',['list'=>$list]);
    }

    public function createForm()
    {
        return view('posts.createForm');
    }

    public function create(Request $request)
    {
        $post = $request->input('newPost');
        DB::table('posts')->insert([
            'post' => $post,
            'user_id' => Auth::id(),
            // 'created_at' => Auth::id(),
            // 'images' => Auth::id(),
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
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        DB::table('posts')
            ->where('id',$id)
            ->update(
                ['post' => $up_post]
            );
        return redirect('/top');
    }

    public function delete($id)
    {
        DB::table('posts')
            ->where('id',$id)
            ->delete();
        return redirect('/top');
    }

    public function show($id)
    {
        $val = Post::with('user')->where('id', $id)->first();

        return view('/top')->with('val',$val);
    }

}
