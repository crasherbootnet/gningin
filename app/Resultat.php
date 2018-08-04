<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    public $table = 'resultats';
    public $fillable = ['project_id', 'libelle', 'content', "project_historisation_id"];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function projectHistorisation(){
        return $this->belongsTo('App\ProjectHistorisation');
    }
}
