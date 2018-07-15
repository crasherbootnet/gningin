<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composante extends Model
{
    public $table = "composantes";
    public $fillable = ["project_id", "content"];
}
