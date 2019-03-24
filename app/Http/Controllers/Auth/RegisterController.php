<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\Email;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/member/info/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $this->title = '注册';
        return $this->view('auth.register');
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        if ($user == '1') {
            return redirect()->back()->withInput()->with('code', '验证码过期，请重新获取');
        } elseif ($user == '2') {
            return redirect()->back()->withInput()->with('code', '验证码不正确，请重新输入');
        } else {
            $this->guard()->login($user);
            return $this->registered($request, $user)
                ?: redirect($this->redirectPath());
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'code.required' => '验证码不能为空',
            'code.digits' => '验证码必须是6位数字',
        ];
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'code' => 'required|digits:6',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $res = Email::where(['email' => $data['email'], 'type' => 1])->orderBy('created_at', 'desc')->get();
        if (time() - strtotime($res[0]['created_at']) > 300) {
            return 1;
        }
        if ($res[0]['code'] != $data['code']) {
            return 2;
        }
        return User::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'email' => $data['email'],
        ]);
    }

    public function forgot(Request $request)
    {
        $messages = [
            'code.required' => '验证码不能为空',
            'code.digits' => '验证码必须是6位数字',
        ];
         Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'code' => 'required|digits:6',
        ], $messages);

        event(new Registered($user = $this->store($request->all())));
        if ($user == '3') {
            return redirect()->back()->withInput()->with('code', '验证码过期，请重新获取');
        } elseif ($user == '2') {
            return redirect()->back()->withInput()->with('code', '验证码不正确，请重新输入');
        } else {
            return redirect()->route('login')->with('success', '密码修改成功，请重新登陆');
        }
    }

    protected function store(array $data)
    {
        $res = Email::where(['email' => $data['email'], 'type' => 3])->orderBy('created_at', 'desc')->first();
        if (time() - strtotime($res['created_at']) > 300) {
            return 3;
        }
        if ($res['code'] != $data['code']) {
            return 2;
        }
        return User::where('email', $data['email'])->update([
            'password' => bcrypt($data['password']),
        ]);
    }
}
