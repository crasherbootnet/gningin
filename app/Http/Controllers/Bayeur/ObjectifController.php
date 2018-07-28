<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Objectif;

class ObjectifController extends Controller
{
    public function show($short_code){
        
        // recuperation de l'objectif du project
        $project = Project::where('short_code', $short_code)->first();
        $objectif = $project->objectif ?? null;

        return view('bayeurs.projects.objectifs', ['objectif' => $objectif, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

    	// update or create objectif for this project
    	if($project->objectif){
			Objectif::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Objectif::create([
								'project_id' => $project->id, 
								'content' => $request->content
							]);
    	}

    	return redirect('bayeurs.projects/show/'.$short_code);
    }
}
