<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Project;
use App\Categorie;
use App\ProjectCategorie;
use App\ProjectHistorisation;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // recuperation de tous les projects du systeme
        $projects = Project::all();
        
        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // recuperation de toutes les categories
        $categories = Categorie::all();

        return view('projects.add', ['categories' => $categories ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->categories);
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
                        'short_code' => strtolower(substr($request->libelle,0,strlen($request->libelle)/2))
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
        } catch (Exception $e) {
            // trait error
        }

        return redirect('projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($short_code)
    {
        // recuperation des informations du project
        $project = Project::where('short_code', $short_code)->first();

        return view('projects.dashboard', ['project' => $project ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveHistorisation(Request $request, $short_code)
    {
        try {
            // recuperation des informations du project
            $project = Project::where('short_code', $short_code)->first(); 

            // on vérifie si nous avons une modification 
            if(!$project->isModification())
            {
                return 2;
            }

            // historisation du project
            ProjectHistorisation::create([
                                            'id' => uniqid(), 
                                            'project_id' => $project->id,
                                            'libelle' =>$request->name,
                                            "date_envoi" => date("Y-m-d H:i:s")
                                        ]);
            return 1;
        } catch (Exception $e) {
            
        }

        return 0;
    }

    /*
        @param string $short_code
        @return true si nous avons une modification
    */
    public function isModification($short_code)
    {
        // recuperation des informations du project
        $project = Project::where('short_code', $short_code)->first(); 

        // on vérifie si nous avons une modification 
        if(!$project->isModification())
        {
            return 0;
        }

        return 1;
    }
}
