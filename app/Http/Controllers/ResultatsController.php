<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Resultat;
use App\ProjectHistorisation;

class ResultatsController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  string $short_code
     * @return \Illuminate\Http\Response
     */
    public function show($short_code)
    {
        // recuperation des resultats du project
        $project = Project::where('short_code', $short_code)->first();
        $resultats = $project->resultats ?? null;

        return view('projects.resultats', ['resultats' => $resultats, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

		if($project->resultat)
        {
            
            if($this->haveYouHistorisation($project))
            {
                // nous historisons le resultat
                $this->makeHistorisation($short_code);
            }

            $this->createOrUpdate($project, $request);          
        }else{
            $this->createOrUpdate($project, $request);
		}
		
		
		// on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();

    	return redirect('projects/show/'.$short_code);
	}
	
	public function haveYouHistorisation(Project $project){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->get()->reverse()->first();

            if($projectHistorisation && !Resultat::where('project_historisation_id', $projectHistorisation->id)->first()){
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
        
        // recuperation du resultat et creation d'un nouveau resultat
        $resultat = $project->resultat;
        Resultat::create($resultat->toArray());

        // ajout de la cle de l'historisation a l'ancien resultat
        $resultat->project_historisation_id = $projectHistorisation->id;
        $resultat->save();

        return $resultat;
	}
	
	public function createOrUpdate(Project $project, $request)
    {
        // update or create resultats for this project
        $resultats = json_decode($request->resultats);
        if($resultats){
            // suppression de tous les resultats du project 
            Resultat::where('project_id', $project->id)->delete();
            foreach ($resultats as $resultat) {
                Resultat::create([
                                    'project_id' => $project->id,
                                    'libelle'   => $resultat->libelle,
                                    'content'   => $resultat->content
                ]);
            }
        }

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }
}
