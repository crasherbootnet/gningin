<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Project;
use App\CadreLogique;

class CadreLogiqueController extends Controller
{
    public function show($short_code){
        
        // recuperation du projet du cadre logique
        $project = Project::where('short_code', $short_code)->first();
        $cadre_logique = $project->cadreLogique ?? null;

        return view('projects.cadre_logique', ['cadre_logique' => $cadre_logique, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

    	// update or create cadre logique for this project
    	if($project->cadreLogique){
			CadreLogique::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		CadreLogique::create([
								'project_id' => $project->id, 
								'content' => $request->content
							]);
    	}

    	return redirect('projects/show/'.$short_code);
    }
}
