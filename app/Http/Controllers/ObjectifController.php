<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Objectif;
use App\ProjectHistorisation;

class ObjectifController extends Controller
{
    public function show($short_code){
        
        // recuperation de l'objectif du project
        $project = Project::where('short_code', $short_code)->first();
        $objectif = $project->objectif ?? null;

        return view('projects.objectifs', ['objectif' => $objectif, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null){

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du objectif
        $objectif = $project->objectif;

        if($objectif)
        {
            // on vérifie si nous avons un changement
            if($objectif->isChanged($request->content)){
                // on met a jour le objectif
                $objectif->updateModel($request);
            }
        }else{
            // creation d'un nouveau objectif
            $objectif = new Objectif;
            $objectif->createModel($request, $project);
        }

        return redirect('projects/show/'.$short_code);
    }
}
