<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Composante;

class ComposanteController extends Controller
{
    public function show($short_code){

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du projectHistorisation
        $projectHistorisation = $project->projectHistorisation();
        
        // recuperation du composante du project
        $composante = $projectHistorisation->composante;

        return view('bayeurs.projects.composante', ['composante' => $composante, 'project' => $project]);
    }
}
