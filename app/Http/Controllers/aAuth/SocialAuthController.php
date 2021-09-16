<?php

namespace App\Http\Controllers\aAuth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    private $socialSecretPassKey = "3t2hi2sis6asm8ile31";
    private $provider = "google";
    public function __construct(){
        $this->middleware(['guest']);
    }

    public function googleRequest(){
        return Socialite::driver('google')->redirect();
    }



    public function googleResponse(){
        $user = Socialite::driver('google')->user();

        $email = $user->email;
        $userPic = $user->avatar;
        $fname = $user->user['given_name'];
        $lname = $user->user['family_name'];
        $password = $email.$this->socialSecretPassKey;

        if (!User::where('email', $email)->first()) {
          User::create([
              'fname' => $fname,
              'lname' => $lname,
              'email' => $email,
              'password' => Hash::make($password),
              'user_pic' => $userPic,
              'provider' => $this->provider,
              
          ]);
        }

        Auth::attempt([
            'email' => $email,
            'password' => $password,
        ], 'on');

        return redirect()->route('home');

    }
}
