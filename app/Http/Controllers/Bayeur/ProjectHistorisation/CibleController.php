<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectHistorisation;

class CibleController extends Controller
{
    public function show($project_historisation_id){
        // recuperation du cible du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $cible = $projectHistorisation->cible ?? null;
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'cible' => $cible
                ]; 
    	return view('bayeurs.projectshistorisations.cible', $data);
    }
}
