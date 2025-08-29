<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastContent extends Model
{
    use HasFactory;


     // Specify the table if it doesn't follow Laravel's naming conventions
     protected $table = 'podcast_content';

     // Specify the fillable fields
     protected $fillable = ['description'];
}
