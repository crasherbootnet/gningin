<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Execution extends Model
{
    public $table = "executions";
    public $fillable = ["project_id", "content"];
}
