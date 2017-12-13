<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'email',
        'password',
        'api_token',
        'remember_token',
        'created_at',
        'updated_at',
    
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAttribute(){
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }
}
