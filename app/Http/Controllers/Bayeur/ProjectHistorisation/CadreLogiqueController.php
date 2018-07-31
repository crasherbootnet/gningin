<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectHistorisation;

class CadreLogiqueController extends Controller
{
    public function show($project_historisation_id){
        // recuperation du cadrelogique du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $cadrelogique = $projectHistorisation->cadrelogique ?? null;
        //dd($projectHistorisation->project->getAllProjectsHistorisations());
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'cadrelogique' => $cadrelogique
                ]; 
    	return view('bayeurs.projectshistorisations.cadrelogique', $data);
        //return view('bayeurs.projectshistorisations.cadrelogique', [ 'projectHistorisation' => $projectHistorisation, 'project' => $projectHistorisation->project]);
    }
}
