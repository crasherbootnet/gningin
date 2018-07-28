<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Context;
use App\Project;
use App\ProjectHistorisation;

class ContextController extends Controller
{
    public function show($short_code){
        
        // recuperation du context du project
        $project = Project::where('short_code', $short_code)->first();
        $context = $project->context ?? null;

        return view('projects.context', ['context' => $context, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

        if($project->context)
        {
            //dd($this->isChanged($project, $request->content));
            if($this->isChanged($project, $request->content)){
                //dd($this->haveYouHistorisation($project));
                if($this->haveYouHistorisation($project))
                {
                    // nous historisons le context
                    $this->makeHistorisation($short_code);
                }

                //dd("evzegz");

                $this->createOrUpdate($project, $request);          
            }
        }else{
            $this->createOrUpdate($project, $request);
        }

    	return redirect('projects/show/'.$short_code);
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

            if($projectHistorisation && !Context::where('project_historisation_id', $projectHistorisation->id)->first()){
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

        return $context;
    }

    public function createOrUpdate(Project $project, $request)
    {
        // update or create context for this project
        //dd(Context::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first()->update(['project_id' => $project->id]));
            if($project->context){
                Context::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first()
                        ->update(['content' => $request->content]);
            }else{
                Context::create([
                                    'project_id' => $project->id, 
                                    'content' => $request->content
                                ]);
            }
    }
}
