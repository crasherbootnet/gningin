<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public $table = "categories";
    public $fillable = ["libelle", "active"];

    public function projectsCategories(){
    	return $this->hasMany('App\ProjectCategorie');
    }
}
