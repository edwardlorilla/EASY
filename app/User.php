<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','firebase_uid', 'school', 'country', 'field', 'lastName', 'firstName', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function photo(){
        return $this->belongsTo(Photo::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function repositories(){
        return $this->hasMany(Repository::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
