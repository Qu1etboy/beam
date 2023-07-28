<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{   
    public function redirectToGoogle() {
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
        }

    
        Auth::login($newUser);
    
        return redirect('/');    
    }
}