<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table      = 'projects';
	protected $fillable   = ["ong_id", "libelle","date_debut","date_fin","short_code", "type_project_id"];

	public function context(){
		return $this->hasOne('App\Context')->whereNull('project_historisation_id');
	}

	public function justificatif(){
		return $this->hasOne('App\Justificatif');
	}

	public function objectif(){
		return $this->hasOne('App\Objectif');
	}

	public function cible(){
		return $this->hasOne('App\Cible');
	}

	public function resultats(){
		return $this->hasMany('App\Resultat');
	}

	public function composante(){
		return $this->hasOne('App\Composante');
	}

	public function methodologie(){
		return $this->hasOne('App\Methodologie');
	}

	public function hypothese(){
		return $this->hasOne('App\Hypothese');
	}

	public function activites(){
		return $this->hasMany('App\Activite');
	}

	public function cadreLogique(){
		return $this->hasOne('App\CadreLogique');
	}

	public function execution(){
		return $this->hasOne('App\Execution');
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
    	return $this->hasMany('App\ProjectHistorisation');
    }

    /*
		@return ProjectHistorisation // le dernier projectHisroisation
										associe au project
    */
    public function projectHistorisation()
    {
    	$projectsHistorisations = $this->hasMany('App\ProjectHistorisation')
    							       ->get();
   		if($projectsHistorisations){
        	return $projectsHistorisations[count($projectsHistorisations)-1];
   		}

   		return null;
    }

    /*	Permet de retourner true si le project a été modifie 
		@return true 
    */
    public function isModification(){
    	if($this->context)
    	{
    		return true;
    	}else{
    		return false;
    	}
    }
}
