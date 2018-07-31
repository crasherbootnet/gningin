<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectHistorisation;

class JustificatifController extends Controller
{
    public function show($project_historisation_id){
        // recuperation du justificatif du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $justificatif = $projectHistorisation->justificatif ?? null;
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'justificatif' => $justificatif
                ]; 
    	return view('bayeurs.projectshistorisations.justificatif', $data);
    }
}
