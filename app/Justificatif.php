<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justificatif extends Model
{
    public $table = "justificatifs";
    public $fillable = ['project_id', 'content'];

    public function project(){
    	return $this->hasOne('App\Project');
    }
}
