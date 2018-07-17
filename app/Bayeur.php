<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bayeur extends Model
{
    public $table = "bayeurs";
    public $fillable = ["user_id"];

    public function ongs(){
    	return $this->hasMany('App\Ong');
    }

    public function projects(){
    	return $this->hasMany('App\Project');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
