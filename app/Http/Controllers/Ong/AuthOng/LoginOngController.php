<?php

namespace App\Http\Controllers\Ong\AuthOng;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginOngController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/ongs';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        return view('ongs.auth.login');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/ongs/login');
    }
}
