<?php

namespace App\Http\Controllers\aAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    private $profileDefault = "default.png";
    public function __construct(){
        $this->middleware(["guest"]);
    }
    
    public function index(){
        return view('Auth.signup');
    }

    public function signup(Request $request){
        //dd($request);
       $request->validate([
           'fname' => 'required|max:255',
           'lname' => 'required|max:255',
           'email' => 'required|email|max:255',
           'password' => 'required|confirmed|min:6',
           'gender' => 'required|in:male,female,other',
           'terms' => 'accepted',
           'g-recaptcha-response' => 'required|captcha',
       ]);


    //    if (User::where('email',$request->email)->first()) {
    //        return back()->with('e_existance', 'The email already exist!!!');
    //    }

    if (User::where('email', $request->email)->exists()) {
        return back()->with('e_existance', 'The email already exist!!!');
    }

    User::create([
        'fname' => $request->fname,
        'lname' => $request->lname,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'gender' => $request->gender,
        'user_pic' => $this->profileDefault,
    ]);

    Auth::attempt([
        'email' => $request->email,
        'password' => $request->password,
    ]);

       return redirect()->route('home');
    }
}
