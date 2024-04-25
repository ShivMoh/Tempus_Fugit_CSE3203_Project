<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
        ]);

        //possibly more secure
        //return redirect()->intended('/dashboard');

        return view('/dashboard');

        return back()->withErrors([
            'email' => 'Blah blah blah',
        ]);
    }
}
