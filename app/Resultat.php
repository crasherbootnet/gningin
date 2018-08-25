<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultat extends DksModel
{
    public $table = 'resultats';
    protected $name = "Resultat";
    public $fillable = ['project_id', 'libelle', 'content', "project_historisation_id"];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function projectHistorisation(){
        return $this->belongsTo('App\ProjectHistorisation');
    }

    public function createModel($request, $project)
    {
    	dd("create");
    }

    public function updateModel($request)
    {
    	dd("update");
    }
}
