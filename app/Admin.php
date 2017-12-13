<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {

        protected $table = 'admins';

	protected $guard = "admins";

	protected $fillable = [
		'id',
		'firstname',
		'lastname',
		'email', 
		'password',
		'remember_token',
		'created_at',
		'updated_at',
	];

	protected $hidden = ['password', 'remember_token',];

	/*
	 * The attribute included the model's JSON.
	 * get First name and Last name together
	 */
	public function getNameAttribute(){
		return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
	}
}
