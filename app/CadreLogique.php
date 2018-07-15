<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CadreLogique extends Model
{
    public $table = "cadres_logiques";
    public $fillable = ["project_id", "content"];
}
