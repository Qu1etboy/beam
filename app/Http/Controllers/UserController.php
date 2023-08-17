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
        $events = $user->joinedEvents()->get();
        return view('orders', compact('events'));
    }

    /**
     * Show the form for editing the user settings.
     */
    public function settings()
    {
        $user = User::find(Auth::id());
        // split the name into first and last
        $name = explode(' ', $user->name, 2);
        $first_name = $name[0];
        $last_name = $name[1];
        return view('settings', compact('user', 'first_name', 'last_name'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' =>  ['required', 'string', 'min:1','max:255'],
            'last_name' => ['required', 'string', 'min:1','max:255'],
            'socials' => ['nullable', 'string', 'max:255'],
            // 'email' => 'required|email|max:255|unique:users,email,' . $user->id, // This line enforces unique emails and ignores the current user
            'profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg','max:2048'],
            // 'certificates' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg' ,'max:2048'],
            'about' => ['nullable', 'string']
        ]);

        $user = User::find(Auth::id());
        
        // Check if user uploading a file, if uploaded store in storage
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $path = $file->storeAs(
                'public/avatars',
                $user->id . '.' . $file->getClientOriginalExtension()
            );
            $filePath = str_replace('public/', '', $path);

            // Update avatar field in user model
            $user->avatar = $filePath;
        }
        
        // Check if user uploading a file, if uploaded certificates and store in storage
        if ($request->hasFile('certificates')) {
            $file = $request->file('certificates');
            $filePath = $request->file('certificates')->store('certificates', 'public');

            // Update certificates field in user model
            $user->certificate = $filePath;
        }
        
        // update other fields
        $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
        // $user->email = Auth::user()->email;
        $user->social = $request->input('socials');
        $user->about = $request->get('about');
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}