<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Methodologie;
use App\Project;
use App\ProjectHistorisation;

class MethodologieController extends Controller
{
    public function show($short_code){
        
        // recuperation du methodologie du project
        $project = Project::where('short_code', $short_code)->first();
        $methodologie = $project->methodologie ?? null;

        return view('projects.methodologie', ['methodologie' => $methodologie, 'project' => $project]);
    }

    public function store(Request $request, $short_code = null)
    {

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du methodologie
        $methodologie = $project->methodologie;

        if ($methodologie) {
            // on vérifie si nous avons un changement
            if ($methodologie->isChanged($request->content)) {
                // on met a jour le methodologie
                $methodologie->updateModel($request);
            }
        } else {
            // creation d'un nouveau methodologie
            $methodologie = new Methodologie();
            $methodologie->createModel($request, $project);
        }

        return redirect('projects/show/' . $short_code);
    }
}
