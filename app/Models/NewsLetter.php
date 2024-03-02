<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use HasFactory;

    protected $table = 'newsletters';

    protected $fillable = [
        'name',
        'description',
        'content',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function newsletterCategories()
    {
        return $this->hasMany(NewsletterCategory::class);
    }
}
