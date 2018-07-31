<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectHistorisation;

class ContextController extends Controller
{
    public function show($project_historisation_id){
        // recuperation du context du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $context = $projectHistorisation->context ?? null;
        //dd($projectHistorisation->project->getAllProjectsHistorisations());
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'context' => $context
                ]; 
    	return view('bayeurs.projectshistorisations.context', $data);
        //return view('bayeurs.projectshistorisations.context', [ 'projectHistorisation' => $projectHistorisation, 'project' => $projectHistorisation->project]);
    }

    /*public function getAllProjectsHistorisations($project)
    {
    	$months = [];
    	// recuperation des mois
    	foreach ($project->projectshistorisations as $projectHistorisation) {
    		if(!in_array($projectHistorisation->created_at->month, $months))
    		{
    			$months[] = $projectHistorisation->created_at->month;
    		}
    	}

    	$projectshistorisations = [];

    	// regroupement par mois 
    	foreach ($months as $month) {
    		$months_projectsHistorisations = [];

    		// recuperations des projects historisations sans le premier 
    		foreach ($project->projectshistorisations->slice(1) as $projectHistorisation) {
    			$projectHistorisation = (object) $projectHistorisation;
	    		if($projectHistorisation->created_at->month == $month){
	    			$months_projectsHistorisations[] = $projectHistorisation;
	    		}
	    	}

	    	$projectshistorisations[] = (object) [
	    								"month" => $month,
	    								"projectshistorisations" => $months_projectsHistorisations
	    							];

    	}

    	return $projectshistorisations;
    }*/
}
