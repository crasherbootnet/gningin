<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Project;
use App\Categorie;
use App\ProjectCategorie;
use App\ProjectHistorisation;
use App\EtatProject;
use DB;
use App\Context;
use Utility;

class ProjectController extends Controller
{
    
    public function index()
    {   
        // recuperation de tous les projects du systeme
        $projects = Project::all();
        return view('projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        // recuperation de toutes les categories
        $categories = Categorie::all();
        return view('projects.add', ['categories' => $categories ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // recuperation de l'utilisateur
            $user = Auth::user();

            // creation d'un projet
            $data = [   
                        'ong_id' => $user->ong->id,
                        'libelle' => $request->libelle,
                        'date_debut' => $request->date_debut,
                        'date_fin' => $request->date_debut,
                        'type_project_id' => $request->type_projet,
                        'short_code' => Utility::slugify($request->libelle) // create a slug
                    ];
            $project = Project::create($data);

            $categories = json_decode($request->categories); 

            // creation de categorie project
            foreach ($categories as $categorie_id) {
                ProjectCategorie::create([
                                            'categorie_id' => $categorie_id,
                                            'project_id' => $project->id
                                        ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            // trait error
        }

        return redirect('projects');
    }

    public function show($short_code)
    {
        // recuperation des informations du project
        $project = Project::where('short_code', $short_code)->first();
        return view('projects.dashboard', ['project' => $project ]);
    }

    /*
    * Mapped route ajax
    */
    public function isCreatedModification($short_code)
    {
        // recuperation des informations du project
        $project = Project::where('short_code', $short_code)->first();
        return $project->isCreatedModification();
    }

    /*
    * Mapped ajax
    */
    public function saveHistorisation(Request $request, $short_code)
    {
        // recuperation des informations du project
        $project = Project::where('short_code', $short_code)->first();
        return $project->saveHistorisation($request, $short_code);
    }
}
