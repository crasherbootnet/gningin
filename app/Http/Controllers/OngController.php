<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Ong;
use App\Bayeur;

class OngController extends Controller
{

    public function index(){
    	$user = Auth::user();

    	// recuperation de tous comptes ong du bayeur
    	$ongs = $user->bayeur->ongs;

    	// recuperation de tous les ong du bayeur
    	return view('bayeurs.ong.index', ['ongs' => $ongs]);
    }

    public function create(){
    	return view('bayeurs.ong.create');
    }

    // @return view : Return the view list projects in for the bayeurs 
    public function getListProjects($ong_id){
        
        // recuperation de l'ong 
        $ong = Ong::where('id', $ong_id)->first();

        // recuperation de tous les projects de l'ong 
        $projects = $ong->projects();

        return view('bayeurs.ong.projects.index', ['projects' => $projects]);
    }

    public function store(Request $request){

    	try {
    		$validator = $this->validator($request->all());
	        if ($validator->fails()) {
	            return redirect('/bayeurs/ong/create')
	                        ->withErrors($validator)
	                        ->withInput();
	        }else{
	        	// creation d'un access ong
	            $this->createOng($request->all());
	            return redirect('/bayeurs/ong');
	        }	
    	} catch (Exception $e) {
    		// trait exception 
    	}
    }

    public function createOng(array $data){

        // recuperation du bayeur
        $bayeur = Auth::user()->bayeur;

        $data = (object) $data;

    	// creation de l'utilisateur
    	$user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'active' => 0,
                'password' => Hash::make($data->password),
                'is_ong' => 1
            ]);


    	// creation d'une ong
    	Ong::create([
    					'user_id' => $user->id,
    					'bayeur_id' => $bayeur->id
    	]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function changedStatut(Request $request)
    {
        try {
            User::where('id', $request->user_id)
                  ->update([
                            'active' => $request->statut
                        ]);
            return 1;
        } catch (Exception $e) {
            
        }
    }

    public function homeProject(){
        
    }
}
