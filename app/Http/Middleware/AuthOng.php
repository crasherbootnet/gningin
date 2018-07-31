<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class AuthOng
{
   protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /*public function handle($request, Closure $next, ...$guards)
    {

        dd(auth()->guard);
        // recuperation du user
        $user = $this->auth->user();

        if(!($this->auth->user() && $user->is_ong == 1)){
            //return redirect('/ongs/login');
            return redirect()->intended('/ongs/login');
        }

        return $next($request);
    }*/

     public function handle($request, Closure $next, ...$guards)
    {
        // recuperation du user
        $user = $this->auth->user();

        if(($this->auth->user() && $user->is_ong == 1)){
            //dd($request);
            return $next($request);
            //return redirect()->guest('/projects');
            //return redirect()->intended('/ongs/login');
            //dd(session('saveUrl'));
            //return redirect()->route('projects.index');
        }
        
        //session(['saveUrl' => Route::currentRouteName()]);
        //dd(\Request::route()->getName());
        //session(['saveUrl' => \Request::route()->getName()]);
        return redirect('/ongs/login');
    }

    protected function guard()
    {
        return $this->auth->guard('ong');
    }
}
