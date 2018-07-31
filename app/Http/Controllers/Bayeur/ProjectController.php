<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use App\Project;

class ProjectController extends Controller
{
    public function index(){

    	// recuperation de l'utilisateur
    	$user = Auth::user();

    	// recuperation de tous les projects du bayeur
    	$projects = $user->bayeur->projects;

    	return view('bayeurs.projects.index', ['projects' => $projects]);
    }

    public function create(){
    	return view('bayeurs.projects.create');
    }

    public function store(Request $request){
    	try {
    		$this->createProject($request);
        } catch (Exception $e) {
            // trait error
        }

        return redirect('bayeurs/projects');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'libelle' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
        ]);
    }

    public function createProject($data){
    	// recuperation du bayeur
        $bayeur = Auth::user()->bayeur;

        // verification de la données
        $validator = $this->validator($data->all());
        if ($validator->fails()) {
            return redirect('/admin/users/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        	Project::create([
        						'bayeur_id' => $bayeur->id,
        						'libelle'   => $data->libelle,
        						'date_debut' => $data->date_debut,
        						'date_fin' => $data->date_fin,
        						'short_code' => strtolower(substr($data->libelle,0,strlen($data->libelle)/2))
        	]);
        }
    }

    /*
        @param string $short_code => Short code du project
        @return view : Permet de retourner le dashboard du project
    */
    public function show($short_code)
    {
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // on vérifie si le project a une historisation
        if(count($project->projectsHistorisations) == 0)
        {   
            return view('bayeurs.nothing');
        }

        return view('bayeurs.projects.show', ['project' => $project]);
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
