<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\ProjectHistorisation;
use App\Activite;

class ProjectHistorisationController extends Controller
{
    public function index($short_code){

    	// recuperation du project 
    	$project = Project::where('short_code', $short_code)->first();

        $data = ['projectHistorisation' => $project->projectHistorisation(), "projectshistorisations" => $project->getAllProjectsHistorisations() ]; 
    	return view('projectshistorisations.dashbaord', $data);
    }

    public function showVersion($projecthistorisation_id){

        // recuperation du projectHistorisation
        $projectHistorisation = ProjectHistorisation::where('id', $projecthistorisation_id)->first();

        $data = [
                    'projectHistorisation' => $projectHistorisation, 
                    "projectshistorisations" => $projectHistorisation->project->getAllProjectsHistorisations() 
                ]; 
    	return view('projectshistorisations.dashbaord', $data);
    }

    public function showContext($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $context = $projectHistorisation->context;        
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'context' => $context
                ];
    	return view('projectshistorisations.context', $data);
    }

    public function showJustificatif($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $justificatif = $projectHistorisation->justificatif;        
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'justificatif' => $justificatif
                ];
    	return view('projectshistorisations.justificatif', $data);
    }

    public function showObjectif($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $objectif = $projectHistorisation->objectif;  
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'objectif' => $objectif
                ];
    	return view('projectshistorisations.objectif', $data);   
    }

    public function showCible($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $cible = $projectHistorisation->cible;  
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'cible' => $cible
                ];
    	return view('projectshistorisations.cible', $data);   
    }

    public function showResultats($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $resultats = $projectHistorisation->resultats;  
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'resultats' => $resultats
                ];
    	return view('projectshistorisations.resultats', $data);   
    }

    public function showComposante($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $composante = $projectHistorisation->composante;  
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'composante' => $composante
                ];
    	return view('projectshistorisations.composante', $data);   
    }

    public function showMethodologie($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $methodologie = $projectHistorisation->methodologie;  
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'methodologie' => $methodologie
                ];
    	return view('projectshistorisations.methodologie', $data);   
    }

    public function showHypothese($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $hypothese = $projectHistorisation->hypothese;  
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'hypothese' => $hypothese
                ];
    	return view('projectshistorisations.hypothese', $data);   
    }

    public function showCadreLogique($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $cadrelogique = $projectHistorisation->cadreLogique;  
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'cadrelogique' => $cadrelogique
                ];
    	return view('projectshistorisations.cadrelogique', $data);   
    }

    public function showActivites($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $activites = $projectHistorisation->activites;  
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'activites' => $activites
                ];
    	return view('projectshistorisations.activites', $data);   
    }

    public function showActivite($activite_id)
    {
        $activite = Activite::where('id', $activite_id)->first();
        $projectHistorisation = $activite->projectHistorisation;
        $data = [
            'projectHistorisation' => $projectHistorisation, 
            'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
            'activite' => $activite
        ];
        return view('projectshistorisations.show_activite', $data);  
    }

    public function showAmendements($project_historisation_id)
    {
        $projectHistorisation = ProjectHistorisation::where('id', $project_historisation_id)->first();
        $amendements = $projectHistorisation->amendement;  
    	$data = [
                    'projectHistorisation' => $projectHistorisation, 
                    'projectshistorisations' => $projectHistorisation->project->getAllProjectsHistorisations(),
                    'amendements' => $amendements
                ];
    	return view('projectshistorisations.amendements', $data);
    }
}
