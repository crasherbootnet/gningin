<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectHistorisation;

class ObjectifController extends Controller
{
    public function show($project_historisation_id){
        // recuperation des objectifs du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $objectif = $projectHistorisation->objectif ?? null;
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'objectif' => $objectif
                ]; 
    	return view('bayeurs.projectshistorisations.objectif', $data);
    }
}
