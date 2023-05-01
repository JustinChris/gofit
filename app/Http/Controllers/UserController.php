<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{

    public function getLogin() {
        return view('login');
    }

    public function postLogin(Request $request) {

        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);


        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withErrors([
                'passInput' => 'Invalid Credentials'
            ]);
        }

        if ($request->remember) {
            Cookie::queue('email_cookie', $request->email, 120);
            Cookie::queue('password_cookie', $request->password, 120);
        }

        return redirect('/dashboard');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
