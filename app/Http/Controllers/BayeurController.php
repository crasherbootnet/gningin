<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Collection;

use App\Project;

class BayeurController extends Controller
{

	public function __construct()
    {
        //$this->middleware('authBayeur');
    }

    public function index(){

        // recuperation de l'utilisateur en cours 
        $bayeur = Auth::user()->bayeur;

        // recuperation de tous les projects du bayeur
        $projects = $this->getAllProjectsOfBayeur($bayeur);

    	return view('bayeurs.index', ['projects' => $projects ]);
    }


    /*
        @param string $short_code
        @return view : Permet de donner les details du project
    */
    public function getDetail($short_code){

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        return view('bayeurs.projects.detail', ['project' => $project]);
    }

    public function getLogin(){
    	return view('bayeurs.auth.login');
    }

    /*
        @param App\Bayeur $bayeur
        @return array : Permet de retourner tous les projects du bayeur
    */
    public function getAllProjectsOfBayeur($bayeur){
        $projects = new Collection;
        foreach ($bayeur->ongs as $ong) {
            foreach ($ong->projects as $project) {
                $projects->push($project);
            }
        }

        return $projects;
    }
}

