<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

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
}
