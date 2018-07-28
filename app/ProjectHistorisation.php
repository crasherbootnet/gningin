<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectHistorisation extends Model
{
	public $table = "projects_historisation";
	//public $primaryKey = "id";
	public $incrementing = False;
	public $fillable = ["id","project_id","libelle","date_envoi"];

	public function project(){
		return $this->belongsTo('App\Project');
	}

	public function context(){
		return $this->hasOne('App\Context', 'project_historisation_id', 'id');
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

}
