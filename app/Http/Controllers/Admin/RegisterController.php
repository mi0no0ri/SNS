<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // validation
    // validation error

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function register(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'name' => ['required','between:2,12'],
                'email' => ['required','between:4,30','unique:admins,email',],
                'password' => ['required','string','between:4,12'],
                'password confirm' => ['required','string','between:4,12','unique:users,password','same:Password'],
            ],[
                'name.required' => 'お名前を入力してください。',
                'name.max' => 'お名前は12文字以内で入力してください。',
                'email.required' => 'emailを入力してください。',
                'email.email' => '正しいemailを入力してください。',
                'email.max' => 'emailは12文字以内で入力してください。',
                'email.unique' => 'そのメールアドレスはすでに登録されています。',
                'password.required' => 'パスワードを入力してください。',
                'password.min' => 'パスワードは4文字以上で入力してください。',
                'password.confirmed' => '入力されたパスワードが一致しません。',
            ]);
            $data = $request->input();

            $this->create($data);
            return view('admin.added', $data);
        }
        return view('admin.register');
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function added(Request $request)
    {
        $data = [
            'username' => $request->username,
        ];
        return view('admin.added',$data);
    }
}
