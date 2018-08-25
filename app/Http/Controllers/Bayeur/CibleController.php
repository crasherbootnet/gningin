<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Cible;

class CibleController extends Controller
{
    public function show($short_code){
        
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du projectHistorisation
        $projectHistorisation = $project->projectHistorisation();
        
        // recuperation du justificatif du project
        $cible = $projectHistorisation->cible;

        return view('bayeurs.projects.cible', ['cible' => $cible, 'project' => $project]);
    }
}
