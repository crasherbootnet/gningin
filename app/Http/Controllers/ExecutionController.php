<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Execution; 
use App\ProjectHistorisation;

class ExecutionController extends Controller
{
    public function show($short_code){
        
        // recuperation du execution du project
        $project = Project::where('short_code', $short_code)->first();
        $execution = $project->execution ?? null;

        return view('projects.execution', ['execution' => $execution, 'project' => $project]);
    }

	public function store(Request $request, $short_code = null){

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du execution
        $execution = $project->execution;

        if($execution)
        {
            // on vérifie si nous avons un changement
            if($execution->isChanged($request->execution)){
                // on met a jour le execution
                $execution->updateModel($request);
            }
        }else{
            // creation d'un nouveau execution
            $execution = new Execution;
            $execution->createModel($request, $project);
        }

        return redirect('projects/show/'.$short_code);
	}
}
