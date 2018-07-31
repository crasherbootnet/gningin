<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Cible;
use App\ProjectHistorisation;

class CibleController extends Controller
{
    public function show($short_code){
        
        // recuperation du cible du project
        $project = Project::where('short_code', $short_code)->first();
        $cible = $project->cible ?? null;

        return view('projects.cible', ['cible' => $cible, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

		if($project->cible)
        {
            if($this->isChanged($project, $request->cible)){
                if($this->haveYouHistorisation($project))
                {
                    // nous historisons le cible
                    $this->makeHistorisation($short_code);
                }

                $this->createOrUpdate($project, $request);          
            }
        }else{
            $this->createOrUpdate($project, $request);
		}
		
    	// update or create cible for this project
    	if($project->cible){
			Cible::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Cible::create([
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
		//dd($project->cible->content);
        return $project->cible->content == $content ? False: True;
	}
	
	public function haveYouHistorisation(Project $project){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->get()->reverse()->first();

            if($projectHistorisation && !Cible::where('project_historisation_id', $projectHistorisation->id)->first()){
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
        
        // recuperation du cible et creation d'un nouveau cible
        $cible = $project->cible;
        Cible::create($cible->toArray());

        // ajout de la cle de l'historisation a l'ancien cible
        $cible->project_historisation_id = $projectHistorisation->id;
        $cible->save();

        return $cible;
	}
	
	public function createOrUpdate(Project $project, $request)
    {
        if($project->cible){
            Cible::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first()
                    ->update(['content' => $request->content]);
        }else{
            Cible::create([
                                'project_id' => $project->id, 
                                'content' => $request->content
                            ]);
        }

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }
}
