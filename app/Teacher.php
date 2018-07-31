<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $table = 'teachers';
    
    protected $fillable = [
        'name', 'email', 'password', 'active', 'is_bayeur', 'is_ong'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
