<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'email',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function userContacts()
    {
        return $this->hasMany(UserContact::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
