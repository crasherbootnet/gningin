<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends DksModel
{
    public $table = "categories";
    protected $name = "Categorie";
    public $fillable = ["libelle", "active"];

    public function projectsCategories(){
    	return $this->hasMany('App\ProjectCategorie');
    }
}
