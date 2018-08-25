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

        // recuperation du context
        $justificatif = $project->justificatif;

        if($justificatif)
        {
            // on vérifie si nous avons un changement
            if($justificatif->isChanged($request->content)){
                // on met a jour le justificatif
                $justificatif->updateModel($request);
            }
        }else{
            // creation d'un nouveau context
            $justificatif = new Justificatif;
            $justificatif->createModel($request, $project);
        }

        return redirect('projects/show/'.$short_code);
    }
}