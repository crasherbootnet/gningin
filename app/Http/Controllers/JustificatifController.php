<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Justificatif;

class JustificatifController extends Controller
{
    public function show($short_code){
        
        // recuperation du justificatif du project
        $project = Project::where('short_code', $short_code)->first();
        $justificatif = $project->justificatif ?? null;

        return view('projects.justificatif', ['justificatif' => $justificatif, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

    	// update or create justificatif for this project
    	if($project->justificatif){
			Justificatif::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Justificatif::create([
								'project_id' => $project->id, 
								'content' => $request->content
							]);
    	}

    	return redirect('projects/show/'.$short_code);
    }
}