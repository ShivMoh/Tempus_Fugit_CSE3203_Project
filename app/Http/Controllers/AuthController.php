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
        
        $response = redirect('/login');
        $response->headers->set('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');

        return $response;
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

    public function showAuthorizationForm()
    {
        return view('register/authorization_form');
    }

    public function authorizeRegistration(Request $request)
    {
        // Validate the authorization credentials
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user has the admin role
            if ($user->user_role_id == '86efe04b-8be4-4c70-a240-fe9624d89371') {

                session()->flash('success', 'Authorization Successful!');

                // User is an admin, redirect to the registration page
                return redirect('/register');
            }
        }

        // Authorization failed, redirect back with an error message
        return redirect()->back()->withErrors(['authorization' => 'Invalid authorization credentials.']);
    }
}