<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->redirectTo = route('login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // validation
    // validation error
    protected $messages = [
        'username.required' => 'お名前を入力してください。',
        'username.max' => 'お名前は12文字以内で入力してください。',
        'mail.required' => 'emailを入力してください。',
        'mail.email' => '正しいemailを入力してください。',
        'mail.max' => 'emailは12文字以内で入力してください。',
        'mail.unique' => 'そのメールアドレスはすでに登録されています。',
        'password.required' => 'パスワードを入力してください。',
        'password.min' => 'パスワードは4文字以上で入力してください。',
        'password.confirmed' => '入力されたパスワードが一致しません。',
    ];
    protected $rules = [
        'username' => ['required','between:4,12'],
        'mail' => ['required','between:4,12','unique:users,mail',],
        'password' => ['required','string','between:4,12','unique:users,password'],
        'password confirm' => ['required','string','between:4,12','unique:users,password','same:Password'],
    ];

    protected function validator(array $data)
    {
        return Validator::make($data, $this->rules, $this->messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = new User();
        $user->fill($data);
        $user->password = Hash::make($data['password']);
        $user->save();
        return redirect()->route('added');
    }


    public function added(){
        return view('auth.added');
    }
}
