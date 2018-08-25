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

        // recuperation du cible
        $cible = $project->cible;

        if($cible)
        {
            // on vérifie si nous avons un changement
            if($cible->isChanged($request->content)){
                // on met a jour le cible
                $cible->updateModel($request);
            }
        }else{
            // creation d'un nouveau cible
            $cible = new Cible;
            $cible->createModel($request, $project);
        }

        return redirect('projects/show/'.$short_code);
    }
}
