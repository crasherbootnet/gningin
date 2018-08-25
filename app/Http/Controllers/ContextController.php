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

        // recuperation du context
        $context = $project->context;

        if($context)
        {
            // on vérifie si nous avons un changement
            if($context->isChanged($request->content)){
                // on met a jour le context
                $context->updateModel($request);
            }
        }else{
            // creation d'un nouveau context
            $context = new Context;
            $context->createModel($request, $project);
        }

    	return redirect('projects/show/'.$short_code);
    }
}
