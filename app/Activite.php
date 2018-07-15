<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    public $table = "activites";
    public $fillable = ["project_id", "libelle", "short_code", "content", 
    					"rapport_moral", "rapport_financier", "liste_presence"
    					, "date_debut", "date_fin"];

    public function personnes(){
    	return $this->hasMany('App\ActivitePersonne');
    }
}