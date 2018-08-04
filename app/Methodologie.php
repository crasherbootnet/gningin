<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Methodologie extends Model
{
    public $table = "methodologies";
    public $fillable = ["project_id", "content", "project_historisation_id"];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function projectHistorisation(){
        return $this->belongsTo('App\ProjectHistorisation');
    }
}
