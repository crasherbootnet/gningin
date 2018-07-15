<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cible extends Model
{
    public $table = "cibles";
    public $fillable = ["project_id", "content"];
}
