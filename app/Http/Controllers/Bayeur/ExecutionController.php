<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Execution; 

class ExecutionController extends Controller
{
    public function show($short_code){
        
        // recuperation du execution du project
        $project = Project::where('short_code', $short_code)->first();
        $execution = $project->execution ?? null;

        return view('bayeurs.projects.execution', ['execution' => $execution, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

    	// update or create execution for this project
    	if($project->execution){
			Execution::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Execution::create([
								'project_id' => $project->id, 
								'content' => $request->content
							]);
    	}

    	return redirect('bayeurs.projects/show/'.$short_code);
    }
}
