<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Composante;

class ComposanteController extends Controller
{
    public function show($short_code){
        
        // recuperation du composante du project
        $project = Project::where('short_code', $short_code)->first();
        $composante = $project->composante ?? null;

        return view('bayeurs.projects.composante', ['composante' => $composante, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

    	// update or create composante for this project
    	if($project->composante){
			Composante::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Composante::create([
								'project_id' => $project->id, 
								'content' => $request->content
							]);
    	}

    	return redirect('bayeurs.projects/show/'.$short_code);
    }
}
