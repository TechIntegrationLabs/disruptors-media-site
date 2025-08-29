<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media_links';
    protected $fillable = [
        'social_media_link_name',
        'social_media_icon',
        'social_media_link_url',
        'order'
    ];
}
