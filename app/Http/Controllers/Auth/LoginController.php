<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            return redirect('dashboard');
        }
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('dashboard');
        }

        Session::flash('failed','Username dan password salah');
        return redirect("/login");
    }

    public function logout() {
        Auth::logout();

        return redirect('/login');
    }
}