<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class BayeurController extends Controller
{

	public function __construct()
    {
        //$this->middleware('authBayeur');
    }

    public function index(){
    	return view('bayeurs.index');
    }

    public function getLogin(){
    	return view('bayeurs.auth.login');
    }
}
