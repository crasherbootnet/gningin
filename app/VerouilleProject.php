<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerouilleProject extends Model
{
    public $table = "verouilles_projects";
    public $fillable = ["project_id", "dateverouille", "motifverouille", 
                        "datedeverouille", "motifdeverouille"];

    public function project(){
    	return $this->belongsTo('App\Project');
    }
}
