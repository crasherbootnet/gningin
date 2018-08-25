<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Amendement extends DksModel
{
    protected $table = "amendements";
    protected $name = "amendement";
    protected $fillable = ["project_historisation_id", "content"];

    public function projectHistorisation(){
        return $this->belongsTo('App\ProjectHistorisation');
    }
}
