<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Methodologie;
use App\Project;

class MethodologieController extends Controller
{
    public function show($short_code){
        
        // recuperation du methodologie du project
        $project = Project::where('short_code', $short_code)->first();
        $methodologie = $project->methodologie ?? null;

        return view('bayeurs.projects.methodologie', ['methodologie' => $methodologie, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

    	// update or create methodologie for this project
    	if($project->methodologie){
			Methodologie::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Methodologie::create([
								'project_id' => $project->id, 
								'content' => $request->content
							]);
    	}

    	return redirect('bayeurs.projects/show/'.$short_code);
    }
}
