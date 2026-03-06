<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'body', 
        'image_url', 
        'meta_description',
        'location',
        'meta_author',
        'category_id',
        
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}