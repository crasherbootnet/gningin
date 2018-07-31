<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table      = 'projects';
	protected $fillable   = ["is_modification","ong_id", "libelle","date_debut","date_fin","short_code", "type_project_id"];

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
    	if($this->is_modification == 1)
    	{
    		return true;
    	}else{
    		return false;
    	}
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
			foreach($project->projectshistorisations->slice(1, count($project->projectshistorisations)-1) as $projectHistorisation)
			{
    			$projectHistorisation = (object) $projectHistorisation;
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
}
