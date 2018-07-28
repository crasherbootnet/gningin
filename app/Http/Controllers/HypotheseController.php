<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Hypothese; 

class HypotheseController extends Controller
{
    public function show($short_code){
        
        // recuperation du hypothese du project
        $project = Project::where('short_code', $short_code)->first();
        $hypothese = $project->hypothese ?? null;

        return view('projects.hypothese', ['hypothese' => $hypothese, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

    	// update or create hypothese for this project
    	if($project->hypothese){
			Hypothese::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Hypothese::create([
								'project_id' => $project->id, 
								'content' => $request->content
							]);
    	}

    	return redirect('projects/show/'.$short_code);
    }
}
