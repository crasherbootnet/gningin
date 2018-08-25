<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Resultat;
use App\ProjectHistorisation;

class ResultatsController extends Controller
{

    public function show($short_code)
    {
        // recuperation des resultats du project
        $project = Project::where('short_code', $short_code)->first();
        $resultats = $project->resultats ?? null;

        return view('projects.resultats', ['resultats' => $resultats, 'project' => $project]);
    }

    /*public function store(Request $request, $short_code = null){

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation du context
        $resultats = $project->resultats;

        // json decode
        $datas = json_decode($request->resultats);
        dd(in_array(12, $datas));

        if($resultats)
        {
            // suppression des resultats 
            foreach ($resultats as $resultat) {
                $resultat->delete();
            }
        }else{
            foreach ($datas as $data) {
                Resultat::create([
                                    'project_id' => $project->id,
                                    'libelle' => $data->libelle,
                                    'content' => $data->content
                                ]);
            }
        }

        return redirect('projects/show/'.$short_code);
    }*/

    public function store(Request $request, $short_code = null){

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // recuperation des resultats
        $resultats = $project->resultats;

        // json decode
        $datas = json_decode($request->resultats);

        if($resultats)
        {
            foreach ($datas as $data) {
                // on fait un update des resulats
                if(!Resultat::where('libelle', $data->libelle)->first())
                {
                    Resultat::create([
                                        'project_id' => $project->id,
                                        'libelle'    => $data->libelle,
                                        'content'    => $data->content
                                    ]);
                }

                // on change le status de project on le passant en mode modification
                $project->is_modification = 1;
                $project->save();
            }

            // on supprime les resultats qui ne sont plus dans la liste
            foreach ($resultats as $resultat) {
                $verifyForDeleted = True;
                foreach ($datas as $data) {
                    if($data->libelle === $resultat->libelle)
                    {
                        $verifyForDeleted = False;
                    }
                }

                if($verifyForDeleted){
                    $resultat->delete();
                }

                // on change le status de project on le passant en mode modification
                $project->is_modification = 1;
                $project->save();
            }
            
        }else{
            foreach ($datas as $data) {
                Resultat::create([
                                    'project_id' => $project->id,
                                    'libelle'    => $data->libelle,
                                    'content'    => $data->content
                                ]);
            }
        }

        return redirect('projects/show/'.$short_code);
    }
}
