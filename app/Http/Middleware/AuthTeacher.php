<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class AuthTeacher
{

    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // recuperation du user
        $user = $this->auth->user();

        if(!($this->auth->user() && $user->is_ong == 1)){
            //return redirect('/ongs/login');
            return redirect()->intended('/teachers/login');
        }

        return $next($request);
    }
}
