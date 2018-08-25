<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Project;
use App\CadreLogique;
use App\ProjectHistorisation;

class CadreLogiqueController extends Controller
{
    public function show($short_code){
        
        // recuperation du projet du cadre logique
        $project = Project::where('short_code', $short_code)->first();
        $cadre_logique = $project->cadreLogique ?? null;

        return view('projects.cadre_logique', ['cadre_logique' => $cadre_logique, 'project' => $project]);
    }


	public function store(Request $request, $short_code = null){

    	// recuperation du project
    	$project = Project::where('short_code', $short_code)->first();

        // recuperation du cadreLogique
        $cadreLogique = $project->cadreLogique;

        if($cadreLogique)
        {
            // on vérifie si nous avons un changement
            if($cadreLogique->isChanged($request->cadrelogique)){
                // on met a jour le cadreLogique
                $cadreLogique->updateModel($request);
            }
        }else{
            // creation d'un nouveau cadreLogique
            $cadreLogique = new CadreLogique;
            $cadreLogique->createModel($request, $project);
        }

        return redirect('projects/show/'.$short_code);
	}
}
