<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
        $request->validate([
            'username' => ['between:4,12'],
            'mail' => ['between:4,20',Rule::unique('users','mail')->ignore($request->id)],
            'password' => ['alpha_num','between:4,12','nullable','unique:users,password'],
            'bio' => ['max:200'],
            'images' => ['image','file','mimes:jpg,png,bmp,gif,svg']
        ],[
            'username.between' => 'お名前は4文字から12文字で入力してください。',
            'mail.email' => '正しいemailを入力してください。',
            'mail.between' => 'emailは4文字から20文字で入力してください。',
            'mail.unique' => 'そのメールアドレスはすでに登録されています。',
            'password.between' => 'パスワードは4文字から12文字で入力してください。',
            'password.alpha_num' => '英数字で入力してください。',
            'bio.max' => '200文字以内で入力してください。',
            'images.image' => '指定されたファイルが画像ではありません。',
            'images.mimes' => '指定された拡張子（JPG、PNG、BMP、GIF、SVG）ではありません。',
            'images.string' => '英数字で入力してください。'
        ]);

        $user = Auth::user();
        $user->username = $request
            ->input('username');
        $user->mail = $request
            ->input('mail');
        $user->bio = $request
            ->input('bio');

        if($request->password !== null){
            $user->password = bcrypt($request->input('password'));
        }

        if($request->images !== null){
            $user->images = $request
                ->file('images');
        }

        $user->save();

        if(null!==($request->file('images'))){
            $fileName = $request
                ->file('images');
            $path = $request
                ->file('images')
                ->storeAs('public/userIcon',$fileName);
        }
        return redirect()->route('profile');
    }

    public function otherProfile($id){
        $list = DB::table('users')
            ->where('id',$id)
            ->first();

        $posts = DB::table('posts')
            ->leftJoin('users','posts.user_id' , '=' , 'users.id')
            ->where('users.id',$id)
            ->select('posts.id','posts.post','posts.created_at','users.username','users.images')
            ->latest()
            ->get();

        return view('posts.userProfile',['list'=>$list,'posts'=>$posts]);
    }

    public static $editRules = array(
        'password' => 'confirmed'
    );
    public function storeImages(Request $request, User $user)
    {
        $file = $request
            ->images
            ->store('images','public');
        $user->image = str_replace('public/', 'storage', $file);
        $user->save();
        return redirect()
            ->route('storeImages');
    }


    public function search(Request $request)
    {
        $keyword = $request
            ->input('keyword');
        $followings = DB::table('follows')
            ->where('follower_id',Auth::id())
            ->get()
            ->toArray();
        $query = User::query();

        if(!empty($keyword)) {
            $query
            ->where('username','LIKE',"%{$keyword}%")
            ->where('id', '<>', Auth::id());
        }
        $lists = $query
            ->where('id', '<>', Auth::id())
            ->get();

        return view('users.search',['lists'=>$lists,'followings'=>$followings,'keyword'=>$keyword]);
    }
    public function redirect()
    {
        return redirect()->route('profile');
    }

    // フォロー
    public function follow(User $user)
    {
        $follower = auth()
            ->user();
        $is_following = $follower
            ->isFollowing($user->id);
        if(!$is_following) {
            $follower->follow($user->id);
            return back();
        }
    }

    //フォローを外す
    public function unfollow(User $user)
    {
        $follower = auth()
            ->user();
        $is_following = $follower
            ->isFollowing($user->id);
        if($is_following) {
            $follower->unfollow($user->id);
            return back();
        }
    }
}
