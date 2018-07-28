<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\ProjectHistorisation;

class ProjectHistorisationController extends Controller
{
    public function index($short_code){

    	// recuperation du project 
    	$project = Project::where('short_code', $short_code)->first();

    	$data = ['projectHistorisation' => $project->projectHistorisation(), "projectshistorisations" => $this->getAllProjectsHistorisations($project) ]; 
    	return view('bayeurs.projectshistorisations.index', $data);
    }

    public function showVersion($projectHistorisationId)
    {
    	// recuperation de projectHistorisation 
    	$projectHistorisation = ProjectHistorisation::where('id', $projectHistorisationId)->first();

    	$data = ['projectHistorisation' => $projectHistorisation, "projectshistorisations" => $this->getAllProjectsHistorisations($projectHistorisation->project) ]; 
    	return view('bayeurs.projectshistorisations.index', $data);
    }

    public function getAllProjectsHistorisations(Project $project)
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
    }
}
