<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Context;
use App\Justificatif;
use App\Objecrif;
use App\Cible;
use App\Resultat;
use App\Composante;
use App\Methodologie;
use App\Hypothese;
use App\CadreLogique;
use App\Execution;
use App\Activite;
use App\SousActivite;
use App\ProjectHistorisation;
use Mail;
use DB;
use Storage;

class Project extends Model
{	

	private const FORMAT_DOC = 'Word2007';
    private const RAPPORTS_DIRECTORY  = 'rapports';
    private const DOCUMENT_EXTENSION = 'docx';

    protected $table      = 'projects';
    protected $name       = 'Project';
	protected $fillable   = ["is_modification","ong_id", "libelle","date_debut","date_fin",
							 "short_code", "type_project_id", "etat_project_id", "content_closed_project",
							 "dateclosed"];

	public function context(){
		return $this->hasOne('App\Context')->whereNull('project_historisation_id');
	}

	public function justificatif(){
		//return $this->hasOne('App\Justificatif');
		return $this->hasOne('App\Justificatif')->whereNull('project_historisation_id');
	}

	public function objectif(){
		//return $this->hasOne('App\Objectif');
		return $this->hasOne('App\Objectif')->whereNull('project_historisation_id');
	}

	public function cible(){
		//return $this->hasOne('App\Cible');
		return $this->hasOne('App\Cible')->whereNull('project_historisation_id');
	}

	public function resultats(){
		return $this->hasMany('App\Resultat')->whereNull('project_historisation_id');
	}

	public function composante(){
		//return $this->hasOne('App\Composante');
		return $this->hasOne('App\Composante')->whereNull('project_historisation_id');
	}

	public function methodologie(){
		//return $this->hasOne('App\Methodologie');
		return $this->hasOne('App\Methodologie')->whereNull('project_historisation_id');
	}

	public function hypothese(){
		//return $this->hasOne('App\Hypothese');
		return $this->hasOne('App\Hypothese')->whereNull('project_historisation_id');
	}

	public function activites(){
		//return $this->hasMany('App\Activite');
		return $this->hasMany('App\Activite')->whereNull('project_historisation_id');
	}

	public function cadreLogique(){
		//return $this->hasOne('App\CadreLogique');
		return $this->hasOne('App\CadreLogique')->whereNull('project_historisation_id');
	}

	public function execution(){
		//return $this->hasOne('App\Execution');
		return $this->hasOne('App\Execution')->whereNull('project_historisation_id');
	}

	public function statutProject(){
		return $this->hasOne('App\StatutProject');
	}

	/*public function bayeur(){
		return $this->belongsTo('App\Bayeur');
	}*/

	public function ong(){
		return $this->belongsTo('App\Ong');
	}

	public function projectsCategories(){
    	return $this->hasMany('App\ProjectCategorie');
    }

    public function etatProject(){
    	return $this->belongsTo('App\EtatProject');
	}

    public function projectsHistorisations(){
		return $this->hasMany('App\ProjectHistorisation')
					->orderBy('created_at', 'DESC');
	}
	
	public function budget(){
		// calcul le budget de toutes les activites principales
		return $this->activites()->sum('budget');
	}

    /*
		@return ProjectHistorisation // le dernier projectHisroisation
										associe au project
    */
    public function projectHistorisation()
    {
		$projectsHistorisations = $this->hasMany('App\ProjectHistorisation')
									   ->get();
   		if(count($projectsHistorisations) > 0){
        	return $projectsHistorisations[count($projectsHistorisations)-1];
   		}

   		return null;
    }

    /*	Permet de retourner true si le project a été modifie 
		@return true 
    */
    public function isModification(){
    	return $this->is_modification == 1;
	}
	
	/**
	 * Retourne la liste de tous les projets historises sauf le premier
	 */
	public function getAllProjectsHistorisations()
    {

		// recuperation du project 
		$project = $this;
		
		$months = [];
		//dd($project->projectshistorisations);
		//dd($project->projectshistorisations->slice(1, count($project->projectshistorisations)-1));
		// recuperation des mois		
    	foreach ($project->projectshistorisations as $projectHistorisation) {
    		if(!in_array($projectHistorisation->created_at->month, $months))
    		{
    			$months[] = $projectHistorisation->created_at->month;
    		}
    	}

    	$projectshistorisations = [];

    	// regroupement par mois 
    	foreach ($months as $month) {
    		$months_projectsHistorisations = [];
			//dd($project->projectshistorisations->slice(count($project->projectshistorisations)-1));
    		// recuperations des projects historisations sans le premier 
    		//foreach ($project->projectshistorisations->slice(count($project->projectshistorisations)-1) as $projectHistorisation) {
			//foreach($project->projectshistorisations->slice(1, count($project->projectshistorisations)-1) as $projectHistorisation)
			foreach($project->projectshistorisations as $projectHistorisation)
			{
	    		if($projectHistorisation->created_at->month == $month){
	    			$months_projectsHistorisations[] = $projectHistorisation;
	    		}
	    	}

	    	$projectshistorisations[] = (object) [
	    								"month" => $month,
	    								"projectshistorisations" => $months_projectsHistorisations
	    							];

    	}
		
    	return $projectshistorisations;
	}
	
	/**
	 * Permet de creer une historisation
	 * @return True if historisation success
	 */
	public function makeHistorisation(ProjectHistorisation $projectHistorisation){
		/**
		 * Create historisation context
		 */
		$context = $this->context; // recuperation du context
		if($context)
		{
			Context::create($this->context->toArray()); // create new context
			$context->project_historisation_id = $projectHistorisation->id; // ajout de la cle de l'historisation a l'ancien context
			$context->save();
		}

		/**
		 * Create historisation justificatif
		 */
		$justificatif = $this->justificatif; // recuperation du justificatif
		if($justificatif)
		{
        	Justificatif::create($this->justificatif->toArray()); // create new context
			$justificatif->project_historisation_id = $projectHistorisation->id; // ajout de la cle de l'historisation a l'ancien justificatif
			$justificatif->save();
		}

		/**
		 * Create historisation objectif
		 */
		$objectif = $this->objectif; // recuperation du objectif
		if($objectif)
		{
			Objectif::create($this->objectif->toArray()); // create new objectif
			$objectif->project_historisation_id = $projectHistorisation->id; // ajout de la cle de l'historisation a l'ancien objectif
			$objectif->save();
		}

		/**
		 * Create historisation cible
		 */
		$cible = $this->cible; // recuperation du cible
		if($cible)
		{
			Cible::create($this->cible->toArray()); // create new cible
			$cible->project_historisation_id = $projectHistorisation->id; // ajout de la cle de l'historisation a l'ancien cible
			$cible->save();
		}

		/**
		 * Create historisation resultat
		 */
		$resultats = $this->resultats; // recuperation des resultats
		// create new resultats
		foreach($resultats as $resultat){
			Resultat::create($resultat->toArray());
		}
		// ajout de la cle de l'historisation a l'ancien cible
		foreach($resultats as $resultat){
			$resultat->project_historisation_id = $projectHistorisation->id;
			$resultat->save();
		}
		
		/**
		 * Create historisation composante
		 */
		$composante = $this->composante; // recuperation du composante
		if($composante)
		{
			Composante::create($this->composante->toArray()); // create new composante
			$composante->project_historisation_id = $projectHistorisation->id; // ajout de la cle de l'historisation a l'ancien composante
			$composante->save();
		}

		/**
		 * Create historisation methodologie
		 */
		$methodologie = $this->methodologie; // recuperation du methodologie
		if($methodologie)
		{
			Methodologie::create($this->composante->toArray()); // create new methodologie
			$methodologie->project_historisation_id = $projectHistorisation->id; // ajout de la cle de l'historisation a l'ancien methodologie
			$methodologie->save();
		}

		/**
		 * Create historisation hypothese
		 */
		$hypothese = $this->hypothese; // recuperation du hypothese
		if($hypothese)
		{
			Hypothese::create($this->hypothese->toArray()); // create new hypothese
			$hypothese->project_historisation_id = $projectHistorisation->id; // ajout de la cle de l'historisation a l'ancien hypothese
			$hypothese->save();
		}

		/**
		 * Create historisation activites
		 */
		$activites = $this->activites; // recuperation des activites
		// create new activites
		foreach($activites as $activite){
			Activite::create($activite->toArray());

			// historisation des sous activites
			$sousactivites = $activite->sousactivites;

			foreach ($sousactivites as $sousactivite) {
				SousActivite::create($sousactivite->toArray());
			}
		}
		// ajout de la cle de l'historisation a l'ancien cible
		foreach($activites as $activite){
			$activite->project_historisation_id = $projectHistorisation->id;
			$activite->save();

			// ajout de l'id de l'activite historise aux sous activites historises
			foreach ($activite->sousactivites as $sousactivite) {
				$sousactivite->activite_historisation_id = $activite->id;
				$sousactivite->save();
			}
		}

		/**
		 * Create historisation cadreLogique
		 */
		$cadreLogique = $this->cadreLogique; // recuperation du cadreLogique
		if($cadreLogique)
		{
			CadreLogique::create($this->cadreLogique->toArray()); // create new cadreLogique
			$cadreLogique->project_historisation_id = $projectHistorisation->id; // ajout de la cle de l'historisation a l'ancien cadreLogique
			$cadreLogique->save();
		}

		/**
		 * Create historisation execution
		 */
		$execution = $this->execution; // recuperation du execution
		if($execution)
		{
			Execution::create($this->execution->toArray()); // create new execution
			$execution->project_historisation_id = $projectHistorisation->id; // ajout de la cle de l'historisation a l'ancien execution
			$execution->save();
		}
	}

	public function isCreatedModification()
    {
        $response = 1;

        // on vérifie si nous avons la possiblité de créer une modification
        if($this->etat_project_id != 1)
        {
            switch($this->etat_project_id)
            {
                case 3:
                    $response = 3;
                    break;
                case 4:
                    $response = 4;
            }

            return $response;
        }

        // on vérifie si nous avons une modification 
        if($this->is_modification == 0)
        {
            return 0;
        }

        return $response;
    }

    public function isProjectHistorisation($short_code)
    {
        if(count($this->getAllProjectsHistorisations()) >= 1){
            return 1;
        }
        return 0;
    }

    public function saveHistorisation($request, $short_code)
    {
        DB::beginTransaction();
        try {

            // on vérifie si nous avons une modification 
            if($this->is_modification == 0)
            {
                return 2;
            }
            
            // historisation du project
            $projecthistorisation = ProjectHistorisation::create([
                                            'id' => uniqid(), 
                                            'project_id' => $this->id,
                                            'libelle' =>$request->name,
                                            'description' =>$request->description,
                                            "date_envoi" => date("Y-m-d H:i:s")
                                        ]);

        
            // on change l'etat du project
            if($projecthistorisation)
            {
                $this->etat_project_id = 4;
                $this->save();
            }
            
            $this->makeHistorisation($projecthistorisation);

            // generation du fichier word et envoi au ptf
            $this->createDocument($projecthistorisation->id);

            $project = $this;
            
            // envoi de mail au bayeur
            /*Mail::send('emails.email', ['title' => "ddd", 'content' => "dss"], function ($message) use($project)
            {
                $message->from($project->ong->user->email, 'Christian Nwamba');
                $message->to($project->ong->bayeur->user->email);
                $message->subject('Bonjour, vous avez recu un rapport de la part de l\'ong '.$project->ong->user->name);

            });*/

            DB::commit();

            return 1;
        } catch (Exception $e) {
            DB::rollBack();
        }

        return 0;
    }

    public function createDocument($file_name)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        //$text = $section->addText($request->get('name'));
        $text = $section->addText("salut les zeros");
        //$text = $section->addText($request->get('email'));
        //$text = $section->addText($request->get('number'),array('name'=>'Arial','size' => 20,'bold' => true));
        //  $section->addImage("./images/Krunal.jpg");
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, self::FORMAT_DOC);
        Storage::disk('local')->makeDirectory(self::RAPPORTS_DIRECTORY);
        $chemin_relatif = 'app/'.self::RAPPORTS_DIRECTORY.'/'.$file_name.'.'.self::DOCUMENT_EXTENSION;
        echo $objWriter->save(storage_path($chemin_relatif));
        //Storage::disk('local')->put('doc.docx', '');
        //return response()->download(public_path('doc.docx'));
    }

    public function verouilleProject()
    {
    	return $this->hasOne('App\VerouilleProject')->orderBy('created_at', 'DESC');
    }

    /*
 	* @param $user User 
 	* @param $module String
 	* @param $action String
 	@ @return true Si l'utilisateur a la permission de pouvoir effetuer cette action sur ce module du project
    */
    /*public function getPermission($user = null, $module, $action)
    {
    	//if($module == "amendement")
    }*/

    public function isLock()
    {

    	return ($this->verouilleProject && $this->verouilleProject->dateverouille && !$this->verouilleProject->datedeverouille);

    	//return in_array($this->etat_project_id, [5, 7]);
    }

    public function isClosed()
    {
    	return $this->statut_project_id === 1;
    }

    public function getInformationProjectLocked()
    {
    	$information = "";
    	if($this->etat_project_id == 7)
    	{
    		$information = "The project is closed";
    	}else if($this->etat_project_id == 5){
    		$information = "The project is locked";
    	}

    	return $information;
    }
}
