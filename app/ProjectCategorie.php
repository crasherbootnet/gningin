<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCategorie extends Model
{
    public $table = "projects_categories";
    public $fillable = ["categorie_id", "project_id"];

    public function categorie(){
    	return $this->belongsTo('App\Categorie');
    }

    public function projects(){
    	return $this->hasMany('App\Project');
    }
}
