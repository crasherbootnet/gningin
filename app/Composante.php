<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composante extends DksModel
{
    public $table = "composantes";
    protected $name= "Composante";
    public $fillable = ["project_id", "content", "project_historisation_id"];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function projectHistorisation(){
        return $this->belongsTo('App\ProjectHistorisation');
    }
}
