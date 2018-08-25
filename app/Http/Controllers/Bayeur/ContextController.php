<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Context;
use App\Project;
use App\ProjectHistorisation;

class ContextController extends Controller
{
    public function show($short_code){
        
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du projectHistorisation
        $projectHistorisation = $project->projectHistorisation();
        
        // recuperation du context du project
        $context = $projectHistorisation->context;

        return view('bayeurs.projects.context', ['context' => $context, 'project' => $project]);
    }

}
