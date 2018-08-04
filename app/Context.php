<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Context extends Model
{
    protected $table  = 'contexts';
    protected $fillable = ['project_id', 'content', 'project_historisation_id'];

    /*public function project(){
    	return $this->hasOne('App\Project');
    }*/

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function projectHistorisation(){
        return $this->belongsTo('App\ProjectHistorisation');
    }
}
