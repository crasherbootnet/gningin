<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            // recuperation de l'utilisateur
            $user = Auth::user();

            if($user->is_bayeur == 1){
                return redirect('/bayeurs');
            }
            
            if($user->is_ong == 1){
                return redirect('/ongs');
            }
        }

        return $next($request);
    }
}
