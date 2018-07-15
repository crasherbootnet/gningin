<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objectif extends Model
{
    public $table = "objectifs";
    public $fillable = ['project_id', 'content'];
}
