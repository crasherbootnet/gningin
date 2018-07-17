<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table      = 'projects';
	protected $fillable   = ["bayeur_id","libelle","date_debut","date_fin","short_code"];

	public function context(){
		return $this->hasOne('App\Context');
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

	public function bayeur(){
		return $this->belongsTo('App\Bayeur');
	}
}
