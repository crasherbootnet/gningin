<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtatProject extends Model
{
    public $table = "etats_projects";
    public $fillable = ["libelle"];

  	public function projects(){
  		return $this->hasMany('App\Project');
  	}
}
