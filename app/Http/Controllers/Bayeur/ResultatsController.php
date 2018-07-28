<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Resultat;

class ResultatsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $short_code = null)
    {
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // update or create resultats for this project
        $resultats = json_decode($request->resultats);
        if($resultats){
            // suppression de tous les resultats du project 
            Resultat::where('project_id', $project->id)->delete();
            foreach ($resultats as $resultat) {
                Resultat::create([
                                    'project_id' => $project->id,
                                    'libelle'   => $resultat->libelle,
                                    'content'   => $resultat->content
                ]);
            }
        }

        return redirect('bayeurs.projects/show/'.$short_code);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $short_code
     * @return \Illuminate\Http\Response
     */
    public function show($short_code)
    {
        // recuperation des resultats du project
        $project = Project::where('short_code', $short_code)->first();
        $resultats = $project->resultats ?? null;

        return view('bayeurs.projects.resultats', ['resultats' => $resultats, 'project' => $project]);
    }
}
