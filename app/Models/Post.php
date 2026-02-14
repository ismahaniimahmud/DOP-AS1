<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     * Include 'location' as your mandatory custom field.
     */
    protected $fillable = [
        'title', 
        'body', 
        'meta_description',
        'location',
        'meta_author' 
        
    ];
}