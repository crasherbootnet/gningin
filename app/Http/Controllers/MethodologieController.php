<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Methodologie;
use App\Project;
use App\ProjectHistorisation;

class MethodologieController extends Controller
{
    public function show($short_code){
        
        // recuperation du methodologie du project
        $project = Project::where('short_code', $short_code)->first();
        $methodologie = $project->methodologie ?? null;

        return view('projects.methodologie', ['methodologie' => $methodologie, 'project' => $project]);
    }

    /*public function store(Request $request, $short_code = null){

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
		
		// on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();

    	return redirect('projects/show/'.$short_code);
	}*/
	
	public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

		if($project->methodologie)
        {
            if($this->isChanged($project, $request->methodologie)){
                if($this->haveYouHistorisation($project))
                {
                    // nous historisons le methodologie
                    $this->makeHistorisation($short_code);
                }

                $this->createOrUpdate($project, $request);          
            }
        }else{
            $this->createOrUpdate($project, $request);
		}
		
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
		
		// on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();

    	return redirect('projects/show/'.$short_code);
	}
	
	public function isChanged(Project $project, $content){
		//dd($project->methodologie->content);
        return $project->methodologie->content == $content ? False: True;
	}
	
	public function haveYouHistorisation(Project $project){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->get()->reverse()->first();

            if($projectHistorisation && !Methodologie::where('project_historisation_id', $projectHistorisation->id)->first()){
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
        
        // recuperation du methodologie et creation d'un nouveau methodologie
        $methodologie = $project->methodologie;
        Methodologie::create($methodologie->toArray());

        // ajout de la cle de l'historisation a l'ancien methodologie
        $methodologie->project_historisation_id = $projectHistorisation->id;
        $methodologie->save();

        return $methodologie;
	}
	
	public function createOrUpdate(Project $project, $request)
    {
        if($project->methodologie){
            Methodologie::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first()
                    ->update(['content' => $request->content]);
        }else{
            Methodologie::create([
                                'project_id' => $project->id, 
                                'content' => $request->content
                            ]);
        }

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }
}
