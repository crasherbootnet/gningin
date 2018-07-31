<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Project;
use App\CadreLogique;
use App\ProjectHistorisation;

class CadreLogiqueController extends Controller
{
    public function show($short_code){
        
        // recuperation du projet du cadre logique
        $project = Project::where('short_code', $short_code)->first();
        $cadre_logique = $project->cadreLogique ?? null;

        return view('projects.cadre_logique', ['cadre_logique' => $cadre_logique, 'project' => $project]);
    }

    /*public function store(Request $request, $short_code = null){

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
		
		// on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();

    	return redirect('projects/show/'.$short_code);
	}*/
	
	public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

		if($project->cadrelogique)
        {
            if($this->isChanged($project, $request->cadrelogique)){
                if($this->haveYouHistorisation($project))
                {
                    // nous historisons le cadrelogique
                    $this->makeHistorisation($short_code);
                }

                $this->createOrUpdate($project, $request);          
            }
        }else{
            $this->createOrUpdate($project, $request);
		}
		
    	// update or create cadrelogique for this project
    	if($project->cadrelogique){
			CadreLogique::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		CadreLogique::create([
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
		//dd($project->cadrelogique->content);
        return $project->cadrelogique->content == $content ? False: True;
	}
	
	public function haveYouHistorisation(Project $project){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->get()->reverse()->first();

            if($projectHistorisation && !CadreLogique::where('project_historisation_id', $projectHistorisation->id)->first()){
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
        
        // recuperation du cadrelogique et creation d'un nouveau cadrelogique
        $cadrelogique = $project->cadrelogique;
        CadreLogique::create($cadrelogique->toArray());

        // ajout de la cle de l'historisation a l'ancien cadrelogique
        $cadrelogique->project_historisation_id = $projectHistorisation->id;
        $cadrelogique->save();

        return $cadrelogique;
	}
	
	public function createOrUpdate(Project $project, $request)
    {
        if($project->cadrelogique){
            CadreLogique::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first()
                    ->update(['content' => $request->content]);
        }else{
            CadreLogique::create([
                                'project_id' => $project->id, 
                                'content' => $request->content
                            ]);
        }

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }
}
