<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class AuthBayeur
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if(!$this->isBayeur()){
            //return redirect('/bayeurs/login');
            return redirect()->intended('/bayeurs/login');
        }

        return $next($request);
    }

    /*public function authenticate(array $guards)
    {
        return redirect('/dhdbq');
        if (empty($guards)) {
            dd($this->auth);
            return $this->auth->authenticate();
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        throw new AuthenticationException('Unauthenticated.', $guards);
    }*/

    // @return True if user is bayeur
    public function isbayeur()
    {
        $user = $this->auth->user();
        if($user && $user->is_bayeur == 1){
            return true;
        }
        return false;
    }

    protected function guard()
    {
        return $this->auth->guard('bayeur');
    }
}
