<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Activite;
use App\SousActivite;
use DB;

class BudgetController extends Controller
{
    public function index($short_code)
    {
        // recuperation du cible du project
        $project = Project::where('short_code', $short_code)->first();
        $activites = $project->activites ?? null;

        return view('projects.budgets.index', ['activites' => $activites, 'project' => $project]);
    }

    public function ShowBudgetActivite($short_code)
    {
        try{
            // recuperation de l'activite
            $activite = Activite::where('short_code', $short_code)->first();

            return view('projects.budgets.show_budget_activite', ['activite' => $activite, 'project' => $activite->project]);
        }catch(Exception $ex){
            // trait 
        }
    }

    public function registerBudgetActivite(Request $request, $short_code)
    { 
        try{
            // recuperation de l'activite
            $activite = Activite::where('short_code', $short_code)->first();
            $activite->budget = $request->budget;
            $activite->save(); // sauvegarde ou update du budget de l'activite
        }catch(Exception $ex){
            // trait exception
            return 0;
        }

        return 1;
    }

    public function getRegisterSousActivite($short_code)
    {
        try{
            // recuperation de l'activite
            $activite = Activite::where('short_code', $short_code)->first();
        }catch(Exception $ex){

        }

        return view('projects.budgets.add_sousactivite', ['activite' => $activite, 'project' => $activite->project]);
    }

    public function postRegisterSousActivite(Request $request, $short_code)
    {
        DB::beginTransaction();
        try{
            // recuperation de l'activite
            $activite = Activite::where('short_code', $short_code)->first();

            $trim_libelle = str_replace(' ','',$request->libelle);

            // creation d'une sous activite
            $sousactivite = SousActivite::create([
                'activite_id' => $activite->id,
                'libelle' => $request->libelle,
                'budget' => $request->budget,
                'content' => $request->content,
                'short_code' => strtolower(substr($trim_libelle,0,strlen($trim_libelle)/3)),
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin
            ]);

            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            // tarit exception
        }

        return redirect()->route('showBudgetActivite', ['short_code_activite' => $activite->short_code]);
    }

    public function getEditSousActivite($shortcode_sousactivite_id)
    {
        try{
            // recuperation de la sous activite
            $sousactivite = SousActivite::where('short_code', $shortcode_sousactivite_id)->first();

            return view('projects.budgets.edit_sousactivite', [
                                                                'sousactivite' => $sousactivite, 
                                                                'project' => $sousactivite->activite->project
                                                                ]);
        }catch(Exception $ex){
            // trait exception
        }
    }

    public function postEditSousActivite(Request $request, $shortcode_sousactivite)
    {   
        DB::beginTransaction();

        // recuperation de l'activite
        $sousactivite = SousActivite::where('short_code', $shortcode_sousactivite)->first();

        try{
            $trim_libelle = str_replace(' ','',$request->libelle);

            // recuperation de la sous activite
            SousActivite::where('short_code', $shortcode_sousactivite)
                                          ->update([
                                                'libelle' => $request->libelle,
                                                'content' => $request->content,
                                                'short_code' => strtolower(substr($trim_libelle,0,strlen($trim_libelle)/3)),
                                                'date_debut' => $request->date_debut,
                                                'date_fin' => $request->date_fin,
                                                'budget' => $request->budget
                                            ]);
            DB::commit();
        }catch(Exception $ex){
            DB::rollback();
            // trait exception
        }
        return redirect()->route('showBudgetActivite', ['short_code_activite' => $sousactivite->activite->short_code]);
    }
        
}
