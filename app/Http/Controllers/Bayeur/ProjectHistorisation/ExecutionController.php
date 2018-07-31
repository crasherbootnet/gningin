<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectHistorisation;

class ExecutionController extends Controller
{
    public function show($project_historisation_id){
        // recuperation du execution du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $execution = $projectHistorisation->execution ?? null;
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'execution' => $execution
                ]; 
    	return view('bayeurs.projectshistorisations.execution', $data);
    }
}
