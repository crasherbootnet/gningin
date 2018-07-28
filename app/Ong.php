<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ong extends Model
{
    public $table = "ongs";
    public $fillable = ["user_id", "bayeur_id"];

    public function bayeur(){
    	return $this->belongsTo('App\Bayeur');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function projects(){
    	return $this->hasMany('App\Project');
    }
}
