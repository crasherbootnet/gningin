<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Context;
use App\Project;
use App\ProjectHistorisation;

class ContextController extends Controller
{
    public function show($short_code){
        
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du projectHistorisation
        $projectHistorisation = $this->getProjectHistorisation($project);
        
        // recuperation du context du project
        $context = $projectHistorisation ? $projectHistorisation->context : $project->context;

        return view('bayeurs.projects.context', ['context' => $context, 'project' => $project]);
    }

    public function getProjectHistorisation(Project $project)
    {
        $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->first();
        
        if($projectHistorisation->context)
        {
            return $projectHistorisation;
        }else{
            $projectsHistorisations = ProjectHistorisation::all();
            if(count($projectsHistorisations) > 2){
                return $projectsHistorisations[1];
            }
        }

        return null;
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

        if($project->context)
        {
            if($this->isChanged($project, $request->content)){
                if($this->haveYouHistorisation($project))
                {
                    // nous historisons le context
                    $this->makeHistorisation($short_code);
                }

                $this->createOrUpdate($project, $request);          
            }
        }else{
            $this->createOrUpdate($project, $request);
        }

    	return redirect('bayeurs.projects/show/'.$short_code);
    }

    public function haveYouHistorisation(Project $project){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->get()->reverse()->first();

            /*if($projectHistorisation){
                if(!($project->context && $project->context->project_historisation_id == $projectHistorisation->id))
                {
                    dd($project->context->project_historisation_id);
                    return True;
                }
            }*/

            if(!Context::where('project_historisation_id', $projectHistorisation->id)->first()){
                return True;
            }
        } catch (Exception $e) {
            // trait exception
        }

        return False;
    }

    public function isChanged(Project $project, $content){
        return $project->context->content == $content ? False: True;
    }

    public function makeHistorisation($short_code)
    {

        // recuperation du project 
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du dernier project de l'historisation 
        $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first();
        
        // recuperation du context et creation d'un nouveau context
        $context = $project->context;
        Context::create($context->toArray());

        // ajout de la cle de l'historisation a l'ancien context
        $context->project_historisation_id = $projectHistorisation->id;
        $context->save();
    }

    public function createOrUpdate(Project $project, $request)
    {
        // update or create context for this project
            if($project->context){
                Context::where('project_id', $project->id)
                        ->update(['content' => $request->content]);
            }else{
                Context::create([
                                    'project_id' => $project->id, 
                                    'content' => $request->content
                                ]);
            }
    }
}
