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

    public function store(Request $request, $short_code = null){

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du composante
        $composante = $project->composante;

        if($composante)
        {
            // on vérifie si nous avons un changement
            if($composante->isChanged($request->content)){
                // on met a jour le composante
                $composante->updateModel($request);
            }
        }else{
            // creation d'un nouveau composante
            $composante = new Composante;
            $composante->createModel($request, $project);
        }

        return redirect('projects/show/'.$short_code);
    }
}
