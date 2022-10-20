<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        // KALO PASSWORD & EMAILNYA BENER
        if(Auth::attempt($credentials)) {

            // $remember = ($request->remember) ? true : false;

            // if($remember == true){
            //     // Auth::login(Auth::user()->id,true);
            //     return redirect()->intended('/');
            // }

            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // kalo salah
        return back()->with('loginError', 'Login failed!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
