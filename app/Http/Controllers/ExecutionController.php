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

    /*public function store(Request $request, $short_code = null){

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
		
		// on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();

    	return redirect('projects/show/'.$short_code);
	}*/
	
	public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

		if($project->execution)
        {
            if($this->isChanged($project, $request->execution)){
                if($this->haveYouHistorisation($project))
                {
                    // nous historisons le execution
                    $this->makeHistorisation($short_code);
                }

                $this->createOrUpdate($project, $request);          
            }
        }else{
            $this->createOrUpdate($project, $request);
		}
		
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
		
		// on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();

    	return redirect('projects/show/'.$short_code);
	}
	
	public function isChanged(Project $project, $content){
		//dd($project->execution->content);
        return $project->execution->content == $content ? False: True;
	}
	
	public function haveYouHistorisation(Project $project){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->get()->reverse()->first();

            if($projectHistorisation && !Execution::where('project_historisation_id', $projectHistorisation->id)->first()){
                return True;
            }
        } catch (Exception $e) {
            // trait exception
        }

        return False;
	}
	
	public function makeHistorisation($short_code)
    {

        // recuperation du project 
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du dernier project de l'historisation 
        $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first();
        
        // recuperation du execution et creation d'un nouveau execution
        $execution = $project->execution;
        Execution::create($execution->toArray());

        // ajout de la cle de l'historisation a l'ancien execution
        $execution->project_historisation_id = $projectHistorisation->id;
        $execution->save();

        return $execution;
	}
	
	public function createOrUpdate(Project $project, $request)
    {
        if($project->execution){
            Execution::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first()
                    ->update(['content' => $request->content]);
        }else{
            Execution::create([
                                'project_id' => $project->id, 
                                'content' => $request->content
                            ]);
        }

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }
}
