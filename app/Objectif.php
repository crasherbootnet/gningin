<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objectif extends DksModel
{
    public $table = "objectifs";
    protected $name = "objectif";
    public $fillable = ['project_id', 'content', "project_historisation_id"];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function projectHistorisation(){
        return $this->belongsTo('App\ProjectHistorisation');
    }
}
