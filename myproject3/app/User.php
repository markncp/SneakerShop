<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

const ADMIN_TYPE = 1;
const DEFAULT_TYPE = 0;
//const ACTIVE = 1;

class User extends Authenticatable
{   

    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname', 'email', 'username','password','phone', 'addressdetail', 
        'road', 'province', 'subdistrict', 'district', 'zipcode', 'imageFileName'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->type == ADMIN_TYPE;
    }
    
    
}
