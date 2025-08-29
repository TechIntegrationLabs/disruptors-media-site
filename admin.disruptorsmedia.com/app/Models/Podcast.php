<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;


    protected $table = 'podcasts';

    // Specify the attributes that can be mass assigned
    protected $fillable = [
        'video_url',      // URL or path of the video
        'video_poster',
        'video_title'   // Path or data for the video poster
    ];
}
