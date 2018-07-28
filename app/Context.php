<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Context extends Model
{
    protected $table  = 'contexts';
    protected $fillable = ['project_id', 'content', 'project_historisation'];

    public function project(){
    	return $this->hasOne('App\Project');
    }
}
