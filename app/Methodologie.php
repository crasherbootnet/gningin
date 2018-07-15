<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Methodologie extends Model
{
    public $table = "methodologies";
    public $fillable = ["project_id", "content"];
}
