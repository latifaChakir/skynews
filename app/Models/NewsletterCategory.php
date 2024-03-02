<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'newsletter_categories';

    protected $fillable = [
        'newsletter_id',
        'category_id',
    ];

    public function newsletter()
    {
        return $this->belongsTo(NewsLetter::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
