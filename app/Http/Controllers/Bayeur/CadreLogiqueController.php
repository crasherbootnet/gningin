<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\CadreLogique;

class CadreLogiqueController extends Controller
{
    public function show($short_code){
        
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du projectHistorisation
        $projectHistorisation = $project->projectHistorisation();
        
        // recuperation du cadre_logique du project
        $cadre_logique = $projectHistorisation->cadreLogique;

        return view('bayeurs.projects.cadre_logique', ['cadre_logique' => $cadre_logique, 'project' => $project]);
    }
}
