<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Activite;
use App\ActivitePersonne;

class ActivitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($short_code)
    {
        // recuperation du activite du project
        $project = Project::where('short_code', $short_code)->first();
        $activites = $project->activites ?? null;

        return view('projects.activites.index', ['activites' => $activites, 'project' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($short_code)
    {
        // recuperation du projet de l'activité
        $project = Project::where('short_code', $short_code)->first();

        return view('projects.activites.create', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $short_code = null)
    {   
        // recuperation du projet de l'activité
        $project = Project::where('short_code', $short_code)->first(); 

        $trim_libelle = str_replace(' ','',$request->libelle);

        //on vérifie si des personnees on été enregistré
        $personnes = json_decode($request->personnes);

        // enregistrement des activites
        $activite = Activite::create([
                            'project_id' => $project->id,
                            'libelle' => $request->libelle,
                            'content' => $request->content,
                            'short_code' => strtolower(substr($trim_libelle,0,strlen($trim_libelle)/3)),
                            'rapport_moral' => $request->rapport_moral,
                            'rapport_financier' => $request->rapport_financier,
                            'liste_presence' => count($personnes) > 0 ? 1:0,
                            'date_debut' => $request->date_debut,
                            'date_fin' => $request->date_fin
        ]);

        // enregistrement des personnes
        foreach ($personnes as $personne) {
            ActivitePersonne::create([
                               'activite_id' => $activite->id,
                               'nom_prenom' => $personne->name,
                               'fonction' => $personne->fonction,
                               'contact' => $personne->contact,
                               'email' => $personne->contact 
            ]);
        }

        return redirect('projects/activites/'.$short_code);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_short_code, $activite_short_code)
    {
        // recuperation du projet de l'activite
        $project = Project::where('short_code', $project_short_code)->first();

        // recuperation de l'activité
        $activite = Activite::where('short_code', $activite_short_code)->first();

        return view('projects.activites.view', ['project' => $project, 'activite' => $activite]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_short_code, $activite_short_code)
    {
        // recuperation du projet de l'activite
        $project = Project::where('short_code', $project_short_code)->first();

        // recuperation de l'activité
        $activite = Activite::where('short_code', $activite_short_code)->first();

        return view('projects.activites.edit', ['project' => $project, 'activite' => $activite]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_short_code, $activite_short_code)
    {
        // recuperation du projet de l'activité
        $project = Project::where('short_code', $project_short_code)->first(); 

        $trim_libelle = str_replace(' ','',$request->libelle);

        //on vérifie si des personnees on été enregistré
        $personnes = json_decode($request->personnes);

        $query_activite = Activite::where('short_code', $activite_short_code);
        
        // mise de l'activite des activites
        $activite = $query_activite->update([
                            'project_id' => $project->id,
                            'libelle' => $request->libelle,
                            'content' => $request->content,
                            'short_code' => strtolower(substr($trim_libelle,0,strlen($trim_libelle)/3)),
                            'rapport_moral' => $request->rapport_moral,
                            'rapport_financier' => $request->rapport_financier,
                            'liste_presence' => count($personnes) > 0 ? 1:0,
                            'date_debut' => $request->date_debut,
                            'date_fin' => $request->date_fin
        ]);

        if(count($personnes) > 0){
            $activite_id  = $query_activite->first()->id;

            // suppression des personnes
            ActivitePersonne::where('activite_id', $activite_id)->delete();
            
            // enregistrement des personnes
            foreach ($personnes as $personne) {
                ActivitePersonne::create([
                                   'activite_id' => $activite_id,
                                   'nom_prenom' => $personne->name,
                                   'fonction' => $personne->fonction,
                                   'contact' => $personne->contact,
                                   'email' => $personne->contact 
                ]);
            }
        }

        return redirect('projects/activites/'.$project->short_code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_short_code, $activite_short_code)
    {
        // recuperation du projet de l'activité
        $project = Project::where('short_code', $project_short_code)->first(); 
        // suppression de l'activite
        Activite::where('short_code', $activite_short_code)->delete();
        
        return redirect('projects/activites/'.$project->short_code);
    }
}
