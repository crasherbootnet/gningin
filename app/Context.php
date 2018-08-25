<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Context extends DksModel
{
    protected $table  = 'contexts';
    protected $name = "context";
    protected $fillable = ['project_id', 'content', 'project_historisation_id'];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function projectHistorisation(){
        return $this->belongsTo('App\ProjectHistorisation');
    }
}
