<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the user orders.
     */
    public function orders()
    {
        $user = User::find(Auth::id());
        $orders = $user->joinedEvents()->get();
        return view('orders', compact('orders'));
    }

    /**
     * Show the form for editing the user settings.
     */
    public function settings()
    {
        $user = User::find(Auth::id());
        return view('settings', compact('user'));
    }
}
