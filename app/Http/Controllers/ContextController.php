<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Context;
use App\Project;

class ContextController extends Controller
{
    public function show($short_code){
        
        // recuperation du context du project
        $project = Project::where('short_code', $short_code)->first();
        $context = $project->context ?? null;

        return view('projects.context', ['context' => $context, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

    	// update or create context for this project
    	if($project->context){
			Context::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Context::create([
								'project_id' => $project->id, 
								'content' => $request->content
							]);
    	}

    	return redirect('projects/show/'.$short_code);
    }
}
