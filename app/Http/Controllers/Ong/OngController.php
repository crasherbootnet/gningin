<?php

namespace App\Http\Controllers\Ong;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\ong;

class OngController extends Controller
{
    public function index(){

    	// recuperation de l'utilisateur
    	$user = Auth::user();

    	// recuperation de tous les projects 
    	$projects = $user->ong->projects;
    	
    	return view('ongs.index', ['projects' => $projects]); 
    }
}