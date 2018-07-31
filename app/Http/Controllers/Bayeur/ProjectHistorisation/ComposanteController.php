<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectHistorisation;

class ComposanteController extends Controller
{
    public function show($project_historisation_id){
        // recuperation du composante du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $composante = $projectHistorisation->composante ?? null;
        //dd($projectHistorisation->project->getAllProjectsHistorisations());
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'composante' => $composante
                ]; 
    	return view('bayeurs.projectshistorisations.composante', $data);
        //return view('bayeurs.projectshistorisations.composante', [ 'projectHistorisation' => $projectHistorisation, 'project' => $projectHistorisation->project]);
    }
}
