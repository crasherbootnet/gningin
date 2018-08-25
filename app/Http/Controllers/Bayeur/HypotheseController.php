<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Hypothese; 

class HypotheseController extends Controller
{
    public function show($short_code){
        
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du projectHistorisation
        $projectHistorisation = $project->projectHistorisation();
        
        // recuperation du hypothese du project
        $hypothese = $projectHistorisation->hypothese;

        return view('bayeurs.projects.hypothese', ['hypothese' => $hypothese, 'project' => $project]);
    }
}
