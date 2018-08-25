<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Hypothese;

class HypotheseController extends Controller
{
    public function show($short_code){
        
        // recuperation du hypothese du project
        $project = Project::where('short_code', $short_code)->first();
        $hypothese = $project->hypothese ?? null;

        return view('projects.hypothese', ['hypothese' => $hypothese, 'project' => $project]);
    }

	public function store(Request $request, $short_code = null)
    {

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du hypothese
        $hypothese = $project->hypothese;

        if ($hypothese) {
            // on vérifie si nous avons un changement
            if ($hypothese->isChanged($request->hypothese)) {
                // on met a jour le hypothese
                $hypothese->updateModel($request);
            }
        } else {
            // creation d'un nouveau execution
            $hypothese = new Hypothese();
            $hypothese->createModel($request, $project);
        }

        return redirect('projects/show/' . $short_code);
    }
}
