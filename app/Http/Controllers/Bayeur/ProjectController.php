<?php

namespace App\Http\Controllers\Bayeur;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use App\Project;
use App\Amendement;
use DB;
use Mail;
use App\VerouilleProject;
use App\EtatProject;

class ProjectController extends Controller
{
    public function index(){

    	// recuperation de l'utilisateur
    	$user = Auth::user();

    	// recuperation de tous les projects du bayeur
    	$projects = $user->bayeur->projects;

    	return view('bayeurs.projects.index', ['projects' => $projects]);
    }

    public function create(){
    	return view('bayeurs.projects.create');
    }

    public function store(Request $request){
    	try {
    		$this->createProject($request);
        } catch (Exception $e) {
            // trait error
        }

        return redirect('bayeurs/projects');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'libelle' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
        ]);
    }

    public function createProject($data){
    	// recuperation du bayeur
        $bayeur = Auth::user()->bayeur;

        // verification de la données
        $validator = $this->validator($data->all());
        if ($validator->fails()) {
            return redirect('/admin/users/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        	Project::create([
        						'bayeur_id' => $bayeur->id,
        						'libelle'   => $data->libelle,
        						'date_debut' => $data->date_debut,
        						'date_fin' => $data->date_fin,
        						'short_code' => strtolower(substr($data->libelle,0,strlen($data->libelle)/2))
        	]);
        }
    }

    /*
        @param string $short_code => Short code du project
        @return view : Permet de retourner le dashboard du project
    */
    public function show($short_code)
    {
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        // on vérifie si le project a une historisation
        if(count($project->projectsHistorisations) == 0)
        {   
            return view('bayeurs.nothing', ['project' => $project]);
        }

        return view('bayeurs.projects.show', ['project' => $project]);
    }

    /*
        @param App\Bayeur $bayeur
        @return array : Permet de retourner tous les projects du bayeur
    */
    public function getAllProjectsOfBayeur($bayeur){
        $projects = new Collection;
        foreach ($bayeur->ongs as $ong) {
            foreach ($ong->projects as $project) {
                $projects->push($project);
            }
        }

        return $projects;
    }

    public function getAmendement($short_code){

        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();

        //dd($project->projectHistorisation()->amendement);
        //dd(($project->verouilleProject && $project->verouilleProject->dateverouille && !$project->verouilleProject->datedeverouille) || (!$project->verouilleproject && $project->projectHistorisation()->amendement));
        
        return view('bayeurs.projects.amendements', ['project' => $project]);
    }

    public function postAmendement(Request $request, $short_code)
    {
        DB::beginTransaction();
        try{
            // recuperation du project
            $project = Project::where('short_code', $short_code)->first();

            // create un amendement
            $amendement = Amendement::create([
                'project_historisation_id' => $project->projectHistorisation()->id,
                'content' => $request->content
            ]);
            
            // on change l'etat du projet
            if($amendement){
                $project->etat_project_id = 1;
                $project->save();
            }

            // envoi de mail a l'ong
            /*Mail::send('emails.email', ['title' => "ddd", 'content' => "dss"], function ($message) use($project)
            {

                $message->from($project->ong->bayeur->user->email, 'Christian Nwamba');
                $message->to($project->ong->user->email);
                $message->subject('Bonjour, vous avez recu un rapport de la part de votre bayeur '.$project->ong->bayeur->user->name);

            });*/

            DB::commit();
            
        }catch(Exception $e){
            // trait exception
            DB::rollBack();
        }
        return redirect('bayeurs/ong/project-follow/'.$project->short_code);
    }

    public function getParams($short_code){
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();
        
        return view('bayeurs.projects.params', ['project' => $project]);
    }

    public function verouilleProject(Request $request)
    {
        try {
            // recuperation du project
            $project = Project::where('short_code', $request->short_code)->first();

            if(!$project->verouilleProject || ($project->verouilleProject && ($project->verouilleProject->dateverouille && $project->verouilleProject->datedeverouille))){
                // verouille project
                VerouilleProject::create([
                                        'project_id' => $project->id,
                                        'dateverouille' => now(),
                                        'motifverouille' => 'lol'
                                    ]);

                // on change l'etat du project
                // $project->etat_project_id = 5;
                // $project->save();
            }else{
                // on deverouille le project
                $verouilleproject = $project->verouilleProject;
                $verouilleproject->datedeverouille = now();
                $verouilleproject->motifdeverouille = 'lol';
                $verouilleproject->save();

                // on change l'etat du project
                // $project->etat_project_id = 6;
                // $project->save();
            }

            return 1;
        } catch (Exception $e) {
            
        }

        return 0;
    }

    public function getClosedProject($short_code)
    {
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();
        
        return view('bayeurs.projects.closed', ['project' => $project]);
    }

    public function postClosedProject(Request $request, $short_code)
    {
        
        try {
            // recuperation du project
            $project = Project::where('short_code', $request->short_code)->first();

            if($project->short_code == $short_code){
                // on ferme le project
                // $project->etat_project_id = 7;
                // $project->save();
                $project->statut_project_id = 1;
                $project->dateclosed = now();
                $project->content_closed_project = $request->content;
                $project->save();
            }

            return 1;
        } catch (Exception $e) {
            // trait exception            
        }

        return 0;
    }

    public function getFinancedProject($short_code)
    {
        // recuperation du project
        $project = Project::where('short_code', $short_code)->first();
        
        return view('bayeurs.projects.financed', ['project' => $project]);
    }

    public function postFinancedProject(Request $request, $short_code)
    {
        
        try {
            // recuperation du project
            $project = Project::where('short_code', $request->short_code)->first();

            if($project->short_code == $short_code){
                // on ferme le project
                // $project->etat_project_id = 7;
                // $project->save();
                $project->statut_project_id = 2;
                $project->datefinance = now();
                $project->content_finance_project = $request->content;
                $project->save();
            }

            return 1;
        } catch (Exception $e) {
            // trait exception            
        }

        return 0;
    }
}
