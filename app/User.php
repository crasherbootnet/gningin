<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'is_bayeur', 'is_ong'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function bayeur(){
        return $this->hasOne('App\bayeur');
    }

    public function getRedirectPath(){
        $redirectTo = "";

        if($this->is_bayeur == 1){
            $redirectTo = "/bayeurs";
        }else if($this->is_ong == 1){
            $redirectTo = "/ongs";
        }else{
            $redirectTo = "/";
        }

        return $redirectTo;
    }
}
