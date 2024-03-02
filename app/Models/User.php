<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'image',
        'preference',
        'role_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function userContacts()
    {
        return $this->hasMany(UserContact::class);
    }

    public function newsletters()
    {
        return $this->hasMany(Newsletter::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
