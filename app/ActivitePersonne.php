<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivitePersonne extends Model
{
    public $table = "activites_personnes";
    public $fillable = ["activite_id", "nom_prenom", "fonction", "contact", 
    					"email"];
}
