<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile',[
            'title' => 'Profile',
            'active' => '',
            "user" => $request->user()
        ]);
    }

    public function update(Request $request)
    {

        $user= User::findOrFail(Auth::user()->id);

        $validatedData = $request->validate([
            'username' => 'required|max:255|min:5',
            'phone' => 'required',
            'email' => 'required|email:dns',
            'dob' => 'required',
            'profile_img' => 'image|file|max:3060'
        ]);

        if($request->file('profile_img')){
            if($user->profile_img){
                Storage::delete($user->profile_img);
            }
            $validatedData['profile_img'] = $request->file('profile_img')->store('user-images');
        }

        $user->username = $validatedData['username'];
        $user->phone = $validatedData['phone'];
        $user->email = $validatedData['email'];
        $user->dob = $validatedData['dob'];
        $user->profile_img = $validatedData['profile_img'];
        $user->save();
        // dd($user);

        return redirect('/profile')->with('success', 'User data has been updated!');
    }
}
