<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectHistorisation;

class HypotheseController extends Controller
{
    public function show($project_historisation_id){
        // recuperation du hypothese du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $hypothese = $projectHistorisation->hypothese ?? null;
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'hypothese' => $hypothese
                ]; 
    	return view('bayeurs.projectshistorisations.hypothese', $data);
    }
}
