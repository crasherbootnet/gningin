<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectHistorisation;

class MethodologieController extends Controller
{
    public function show($project_historisation_id){
        // recuperation du methodologie du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $methodologie = $projectHistorisation->methodologie ?? null;
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'methodologie' => $methodologie
                ]; 
    	return view('bayeurs.projectshistorisations.methodologie', $data);
    }
}
