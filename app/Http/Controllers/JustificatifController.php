<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Justificatif;
use App\ProjectHistorisation;

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

		if($project->justificatif)
        {
            if($this->isChanged($project, $request->justificatif)){
                if($this->haveYouHistorisation($project))
                {
                    // nous historisons le justificatif
                    $this->makeHistorisation($short_code);
                }

                $this->createOrUpdate($project, $request);          
            }
        }else{
            $this->createOrUpdate($project, $request);
		}
		
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
		
		// on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();

    	return redirect('projects/show/'.$short_code);
	}
	
	public function isChanged(Project $project, $content){
		//dd($project->justificatif->content);
        return $project->justificatif->content == $content ? False: True;
	}
	
	public function haveYouHistorisation(Project $project){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->get()->reverse()->first();

            if($projectHistorisation && !Justificatif::where('project_historisation_id', $projectHistorisation->id)->first()){
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
        
        // recuperation du justificatif et creation d'un nouveau justificatif
        $justificatif = $project->justificatif;
        Justificatif::create($justificatif->toArray());

        // ajout de la cle de l'historisation a l'ancien justificatif
        $justificatif->project_historisation_id = $projectHistorisation->id;
        $justificatif->save();

        return $justificatif;
	}
	
	public function createOrUpdate(Project $project, $request)
    {
        if($project->justificatif){
            Justificatif::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first()
                    ->update(['content' => $request->content]);
        }else{
            Justificatif::create([
                                'project_id' => $project->id, 
                                'content' => $request->content
                            ]);
        }

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }
}