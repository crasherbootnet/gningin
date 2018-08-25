<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Resultat;

class ResultatsController extends Controller
{

    public function show($short_code)
    {
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du projectHistorisation
        $projectHistorisation = $project->projectHistorisation();
        
        // recuperation du resultats du project
        $resultats = $projectHistorisation->resultats;

        return view('bayeurs.projects.resultats', ['resultats' => $resultats, 'project' => $project]);
    }
}
