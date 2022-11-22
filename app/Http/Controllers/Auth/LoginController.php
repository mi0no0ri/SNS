<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->only('mail','password');
            // ログインが成功したら、トップページへ
            if(Auth::check()) {
                return view('posts/index');
            }
            //↓ログイン条件は公開時には消すこと
            if(Auth::guard('user')->attempt($data)){
                return redirect('/top');
            } else {
                return redirect('/login');
            }
        }
        return view("auth.login");
    }

    protected function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        return redirect('/login');
    }
}
