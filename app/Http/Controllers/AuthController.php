<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{   
    public function redirectToGoogle() {
        Session::put('returnUrl', url()->previous());

        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback() {
        $user = Socialite::driver('google')->user();
        
        $newUser = User::where('provider_id', $user->id)->first();

        if (!$newUser) {
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->avatar = $user->avatar;
            $newUser->email = $user->email;
            $newUser->provider_id = $user->id;
            $newUser->save();

            Mail::to($newUser->email)->send(new WelcomeMail($newUser));
            
        }

    
        Auth::login($newUser);
    
        return redirect()->intended(Session::get('returnUrl', '/'));    
    }
}