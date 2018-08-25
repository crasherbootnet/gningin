<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SousActivite extends DksModel
{
    protected $table = "sous_activites";
    protected $name = "SousActivite";
    protected $fillable = ["activite_id", "libelle", "description", "date_debut", "date_fin", "short_code", "content", "budget"];

    public function activite()
    {
        return $this->belongsTo('App\Activite');
    }
}
