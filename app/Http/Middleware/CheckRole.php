<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
    //     if (!Auth::check()) {
    //         return redirect('/login');
    //     }

    //     $user = Auth::user();

    //     if ($user->user_role_id != $role) {
    //         return redirect('/unauthorized');
    //     }

    //     return $next($request);
    // }
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    foreach ($roles as $role) {
        if ($user->user_role_id == $role) {
            return $next($request);
        }
    }

    return redirect('/unauthorized');
    }
}
