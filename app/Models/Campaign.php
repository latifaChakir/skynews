<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'newsletter_id',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function newsletter()
    {
        return $this->belongsTo(NewsLetter::class);
    }
}
