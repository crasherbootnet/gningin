<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatutProject extends Model
{
    protected $table = "statuts_projects";
    protected $fillable = ["libelle"];

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }
}
