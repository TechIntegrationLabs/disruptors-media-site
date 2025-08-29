<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutEmbedCode extends Model
{
    use HasFactory;

    protected $table = "about_embed_codes";
    protected $fillable = ['poster_picture' ,'poster_video'];
}
