<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Objectif;
use App\ProjectHistorisation;

class ObjectifController extends Controller
{
    public function show($short_code){
        
        // recuperation de l'objectif du project
        $project = Project::where('short_code', $short_code)->first();
        $objectif = $project->objectif ?? null;

        return view('projects.objectifs', ['objectif' => $objectif, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

		if($project->objectif)
        {
            if($this->isChanged($project, $request->objectif)){
                if($this->haveYouHistorisation($project))
                {
                    // nous historisons le objectif
                    $this->makeHistorisation($short_code);
                }

                $this->createOrUpdate($project, $request);          
            }
        }else{
            $this->createOrUpdate($project, $request);
		}
		
    	// update or create objectif for this project
    	if($project->objectif){
			Objectif::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Objectif::create([
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
		//dd($project->objectif->content);
        return $project->objectif->content == $content ? False: True;
	}
	
	public function haveYouHistorisation(Project $project){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->get()->reverse()->first();

            if($projectHistorisation && !Objectif::where('project_historisation_id', $projectHistorisation->id)->first()){
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
        
        // recuperation du objectif et creation d'un nouveau objectif
        $objectif = $project->objectif;
        Objectif::create($objectif->toArray());

        // ajout de la cle de l'historisation a l'ancien objectif
        $objectif->project_historisation_id = $projectHistorisation->id;
        $objectif->save();

        return $objectif;
	}
	
	public function createOrUpdate(Project $project, $request)
    {
        if($project->objectif){
            Objectif::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first()
                    ->update(['content' => $request->content]);
        }else{
            Objectif::create([
                                'project_id' => $project->id, 
                                'content' => $request->content
                            ]);
        }

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }
}
