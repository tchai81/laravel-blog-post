<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
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
     * Blog posts associated with user.
     * @return collection
     */
    public function blogPosts()
    {
        return $this->hasMany('App\BlogPost');
    }

    /**
     * Check whether user has the role = 'Owner'
     * @return boolean
     */
    public function isOwner()
    {
        // id = 1 = Owner
        return $this->hasOne('App\UserRoles', 'id', 'role_id')->first()->id === 1;
    }

}
