<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validate;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;
use Auth;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        return view('users.profile',['auth' => $auth]);
    }

    public function edit($id)
    {
        $auth = Auth::user();
        return view('users.profile', ['auth' => $auth]);
    }
    public function profileUpdate(Request $request,User $user)
    {
        // $request->Validate([
        //     'username' => 'required | string | max:255',
        //     'mail' => ['required', 'string', 'email','max:255',Rule::unique('users')->ignore(Auth::id())],
        // ]);

        $user = Auth::user();
        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        $user->bio = $request->input('bio');
        $user->images = $request->file('images');
        $user->save();
        if(null!==($request->file('images'))){
        $fileName = $request->file('images');
        $path = $request->file('images')->storeAs('public/userIcon',$fileName);
        }
        return redirect()->route('profile');
    }
    public function passwordUpdate(request $request)
    {
        // $request->Validate([
        //     'password' => 'required | string | min:8 | confirmed',
        // ]);
        try {
            $user = Auth::user();
            $user->password = bcrypt($request->input('password'));
            $user->save();
        } catch (\Exception $e) {
            return back()->with('msg_error', 'パスワードの更新に失敗しました。')->with();
        }
        return redirect()->route('profile')->with('msg_success','パスワードの更新は完了しました。');
    }

    public function otherProfile($id){
        $list = DB::table('users')->where('id',$id)->first();

        $lists = DB::table('posts')
        ->leftJoin('users','posts.user_id' , '=' , 'users.id')
        ->where('users.id',$id)
        ->select('posts.id','users.username','posts.created_at','posts.post','users.images')
        ->latest()->get();

        return view('posts.userProfile',['list'=>$list,'lists'=>$lists]);
    }

    public static $editRules = array(
        'password' => 'confirmed'
    );
    public function storeImages(Request $request, User $user)
    {
        $file = $request->images->store('images','public');
        $user->image = str_replace('public/', 'storage', $file);
        $user->save();
        return redirect()->route('storeImages');
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $lists = DB::table('users')->get()->toArray();
        $followings = DB::table('follows')->where('follower_id',Auth::id())->get()->toArray();
        $query = User::query();

        if(!empty($keyword)) {
            $query->where('username','LIKE',"%{$keyword}%")->where('id', '<>', Auth::id());
        }
        $lists = $query->where('id', '<>', Auth::id())->get();

        return view('users.search',['lists'=>$lists,'followings' =>$followings]);
    }
    public function redirect()
    {
        return redirect()->route('profile');
    }

    // follow
    public function follow(User $user)
    {
        $follow = DB::table('follows')->where('follow_id', Auth::id())->first();
        if(empty($follow)) {
            $follow->create([
                'follow_id' => $user()->id,
                'follower_id' => $user()->id,
            ]);
        }
    }
    // unfollow
    public function unfollow(User $user)
    {
        // $follower = auth()->user();
        // $is_following = $follower->isFollowing($user->id);
        // if($is_following) {
        //     $follower->unfollow($user->id);
        //     return back();
        // }

        $follower = DB::table('follows')->where('follower_id', Auth::id())->first();
        $follower->delete();

        return redirect('/search');
    }
}
