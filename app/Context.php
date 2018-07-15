<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Context extends Model
{
    protected $table  = 'contexts';
    protected $fillable = ['project_id', 'content'];

    public function project(){
    	return $this->hasOne('App\Project');
    }
}
