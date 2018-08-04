<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Execution extends Model
{
    public $table = "executions";
    public $fillable = ["project_id", "content", "project_historisation_id"];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function projectHistorisation(){
        return $this->belongsTo('App\ProjectHistorisation');
    }
}
