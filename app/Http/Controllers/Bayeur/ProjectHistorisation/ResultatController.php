<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectHistorisation;

class ResultatController extends Controller
{
    public function show($project_historisation_id){
        // recuperation du resultat du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $resultat = $projectHistorisation->resultat ?? null;
        //dd($projectHistorisation->project->getAllProjectsHistorisations());
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'resultat' => $resultat
                ]; 
    	return view('bayeurs.projectshistorisations.resultat', $data);
        //return view('bayeurs.projectshistorisations.resultat', [ 'projectHistorisation' => $projectHistorisation, 'project' => $projectHistorisation->project]);
    }
}
