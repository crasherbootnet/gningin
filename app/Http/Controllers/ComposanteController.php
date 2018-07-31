<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Composante;
use App\ProjectHistorisation;

class ComposanteController extends Controller
{
    public function show($short_code){
        
        // recuperation du composante du project
        $project = Project::where('short_code', $short_code)->first();
        $composante = $project->composante ?? null;

        return view('projects.composante', ['composante' => $composante, 'project' => $project]);
    }

    /*public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

    	// update or create composante for this project
    	if($project->composante){
			Composante::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Composante::create([
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

		if($project->composante)
        {
            if($this->isChanged($project, $request->composante)){
                if($this->haveYouHistorisation($project))
                {
                    // nous historisons le composante
                    $this->makeHistorisation($short_code);
                }

                $this->createOrUpdate($project, $request);          
            }
        }else{
            $this->createOrUpdate($project, $request);
		}
		
    	// update or create composante for this project
    	if($project->composante){
			Composante::where('project_id', $project->id)
					->update(['content' => $request->content]);
    	}else{
    		Composante::create([
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
		//dd($project->composante->content);
        return $project->composante->content == $content ? False: True;
	}
	
	public function haveYouHistorisation(Project $project){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->get()->reverse()->first();

            if($projectHistorisation && !Composante::where('project_historisation_id', $projectHistorisation->id)->first()){
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
        
        // recuperation du composante et creation d'un nouveau composante
        $composante = $project->composante;
        Composante::create($composante->toArray());

        // ajout de la cle de l'historisation a l'ancien composante
        $composante->project_historisation_id = $projectHistorisation->id;
        $composante->save();

        return $composante;
	}
	
	public function createOrUpdate(Project $project, $request)
    {
        if($project->composante){
            Composante::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first()
                    ->update(['content' => $request->content]);
        }else{
            Composante::create([
                                'project_id' => $project->id, 
                                'content' => $request->content
                            ]);
        }

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }
}
