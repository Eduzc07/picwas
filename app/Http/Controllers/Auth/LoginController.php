<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\LoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return redirect()->route('/');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $roleId = User::where('email', $request->email)->first()->role_id;

        if ($roleId !== DB::Table('roles')->where('name', '=', 'photographer')->first()->id) {
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'error' => 'Tu cuenta no es de fotógrafo, prueba ingresar con el login para clientes.',
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $userToLogin = User::where('email', $request->email)->first();

            if (!empty($userToLogin->last_ip_login)) {
                if ($userToLogin->last_ip_login !== $this->getUserIp()) {
                    if ($userToLogin->sign_in_alert) {
                        Mail::to($request->email)->send(new LoggedIn($this->getUserIp()));
                    }
                } else {
                    DB::Table('users')->where('email', $request->email)->update(['last_ip_login'=>$this->getUserIp()]);
                }
            } else {
                if ($userToLogin->sign_in_alert) {
                    Mail::to($request->email)->send(new LoggedIn($this->getUserIp()));
                }
                DB::Table('users')->where('email', $request->email)->update(['last_ip_login'=>$this->getUserIp()]);
            }

            return redirect()->intended('/user');
        } else {
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'error' => 'Los datos de acceso son incorrectos.',
            ]);
        }
    }

    public function loginCustomer(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $roleId = User::where('email', $request->email)->first()->role_id;

        if ($roleId !== DB::Table('roles')->where('name', '=', 'customer')->first()->id) {
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'error' => 'Tu cuenta no es de clientes, prueba ingresar con el login para fotógrafos.',
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $userToLogin = User::where('email', $request->email)->first();
            if (!empty($userToLogin->last_ip_login)) {
                if ($userToLogin->last_ip_login !== $this->getUserIp()) {
                    if ($userToLogin->sign_in_alert) {
                        Mail::to($request->email)->send(new LoggedIn($this->getUserIp()));
                    }
                } else {
                    DB::Table('users')->where('email', $request->email)->update(['last_ip_login'=>$this->getUserIp()]);
                }
            } else {
                if ($userToLogin->sign_in_alert) {
                    Mail::to($request->email)->send(new LoggedIn($this->getUserIp()));
                }
                DB::Table('users')->where('email', $request->email)->update(['last_ip_login'=>$this->getUserIp()]);
            }
            return redirect()->intended('/user');
        } else {
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'error' => 'Los datos de acceso son incorrectos.',
            ]);
        }
    }

    public function getUserIp()
    {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
