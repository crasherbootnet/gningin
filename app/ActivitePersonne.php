<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class ActivitePersonne extends DksModel
{
    public $table = "activites_personnes";
    protected $name = "activitePersonne";
    public $fillable = ["activite_id", "nom_prenom", "fonction", "contact", 
    					"email"];
}
