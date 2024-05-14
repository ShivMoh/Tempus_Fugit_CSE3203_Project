<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return view('login/stay-logged-in');
        }

        return view('login/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->user_role_id == 'eff3a740-b777-48dc-8c04-78893ba6a50b'){
                return redirect()->intended('/cashier');
            } elseif ($user->user_role_id == '86efe04b-8be4-4c70-a240-fe9624d89371'){
                return redirect()->intended('/dashboard');
            }

            return redirect()->intended('/dashboard');
        }

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            return back()->withErrors([
                'password' => 'Your password is incorrect.'
            ]);
        } else {
            return back()->withErrors([
                'email' => 'The provided email does not match our records.'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function stayLoggedIn(Request $request)
    {
        if ($request->input('action') === 'stay') {
            // Extend the session lifetime
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        } elseif ($request->input('action') === 'logout') {
            // Logout the user
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }

        // If no valid action is provided, redirect to the dashboard
        return redirect()->intended('/dashboard');
    }
}