<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Cible;

class CibleController extends Controller
{
    public function show($short_code){
        
        // recuperation du cible du project
        $project = Project::where('short_code', $short_code)->first();
        $cible = $project->cible ?? null;

        return view('bayeurs.projects.cible', ['cible' => $cible, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

    	// update or create cible for this project
    	if($project->cible){
			Cible::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Cible::create([
								'project_id' => $project->id, 
								'content' => $request->content
							]);
    	}

    	return redirect('bayeurs.projects/show/'.$short_code);
    }
}
