<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use Validator;
use App\Http\Controller\Board;

class PostsController extends Controller
{

    public function index()
    {
        $list = DB::table('posts')->get();
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
}
