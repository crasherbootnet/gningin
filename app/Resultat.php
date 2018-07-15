<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    public $table = 'resultats';
    public $fillable = ['project_id', 'libelle', 'content'];
}
