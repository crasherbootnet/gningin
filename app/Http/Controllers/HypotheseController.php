<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Hypothese; 
use App\ProjectHistorisation;

class HypotheseController extends Controller
{
    public function show($short_code){
        
        // recuperation du hypothese du project
        $project = Project::where('short_code', $short_code)->first();
        $hypothese = $project->hypothese ?? null;

        return view('projects.hypothese', ['hypothese' => $hypothese, 'project' => $project]);
    }

    /*public function store(Request $request, $short_code = null){

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
		
		// on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();

    	return redirect('projects/show/'.$short_code);
	}*/
	
	public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

		if($project->hypothese)
        {
            if($this->isChanged($project, $request->hypothese)){
                if($this->haveYouHistorisation($project))
                {
                    // nous historisons le hypothese
                    $this->makeHistorisation($short_code);
                }

                $this->createOrUpdate($project, $request);          
            }
        }else{
            $this->createOrUpdate($project, $request);
		}
		
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
		
		// on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();

    	return redirect('projects/show/'.$short_code);
	}
	
	public function isChanged(Project $project, $content){
		//dd($project->hypothese->content);
        return $project->hypothese->content == $content ? False: True;
	}
	
	public function haveYouHistorisation(Project $project){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->get()->reverse()->first();

            if($projectHistorisation && !Hypothese::where('project_historisation_id', $projectHistorisation->id)->first()){
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
        
        // recuperation du hypothese et creation d'un nouveau hypothese
        $hypothese = $project->hypothese;
        Hypothese::create($hypothese->toArray());

        // ajout de la cle de l'historisation a l'ancien hypothese
        $hypothese->project_historisation_id = $projectHistorisation->id;
        $hypothese->save();

        return $hypothese;
	}
	
	public function createOrUpdate(Project $project, $request)
    {
        if($project->hypothese){
            Hypothese::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first()
                    ->update(['content' => $request->content]);
        }else{
            Hypothese::create([
                                'project_id' => $project->id, 
                                'content' => $request->content
                            ]);
        }

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }
}
