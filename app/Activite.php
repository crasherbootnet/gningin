<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    public $table = "activites";
    public $fillable = ["project_id", "libelle", "short_code", "content", 
    					"rapport_moral", "rapport_financier", "liste_presence"
    					, "date_debut", "date_fin", "project_historisation_id"];

    public function personnes(){
    	return $this->hasMany('App\ActivitePersonne');
    }

    public function project(){
    	return $this->belongsTo('App\Project');
    }

    public function projectHistorisation(){
    	return $this->belongsTo('App\ProjectHistorisation');
    }
}