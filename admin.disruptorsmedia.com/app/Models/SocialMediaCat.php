<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaCat extends Model
{
    use HasFactory;
    
     protected $table = 'social_media_cat';
    protected $fillable = [
        'social_media_cat_name',
    ];

}
