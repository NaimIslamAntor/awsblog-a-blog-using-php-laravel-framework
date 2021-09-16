<?php

namespace App\Http\Controllers\aAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    private $loginFailMsg = 'Email and password are not correct!!!';

    public function __construct(){
        $this->middleware(['guest'])->only('login', 'index');
    }

    public function index(){
        return view('Auth.login');
    }

    public function login(Request $request){
        //dd($request);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ],$request->rememberme)) {
          
            return back()->with('wep', $this->loginFailMsg);
        }

        return redirect()->route('home');
    }

    public function logout(Request $request){
        Auth::logout();
       // dd($request->session());
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}
