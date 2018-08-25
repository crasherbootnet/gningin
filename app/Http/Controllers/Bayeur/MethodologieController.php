<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Methodologie;
use App\Project;

class MethodologieController extends Controller
{
    public function show($short_code){

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du projectHistorisation
        $projectHistorisation = $project->projectHistorisation();
        
        // recuperation du methodologie du project
        $methodologie = $projectHistorisation->methodologie;

        return view('bayeurs.projects.methodologie', ['methodologie' => $methodologie, 'project' => $project]);
    }
}
