<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtatProject extends DksModel
{
    public $table = "etats_projects";
    protected $name = "EtatProject";
    public $fillable = ["libelle"];

  	public function projects(){
  		return $this->hasMany('App\Project');
  	}
}
