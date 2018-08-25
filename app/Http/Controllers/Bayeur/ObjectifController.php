<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Objectif;

class ObjectifController extends Controller
{
    public function show($short_code){

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du projectHistorisation
        $projectHistorisation = $project->projectHistorisation();
        
        // recuperation du context du project
        $objectif = $projectHistorisation->objectif;

        return view('bayeurs.projects.objectifs', ['objectif' => $objectif, 'project' => $project]);
    }
}
