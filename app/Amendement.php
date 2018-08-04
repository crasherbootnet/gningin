<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amendement extends Model
{
    protected $table = "amendements";
    protected $fillable = ["project_historisation_id", "content"];

    public function projectHistorisation(){
        return $this->belongsTo('App\ProjectHistorisation');
    }
}
