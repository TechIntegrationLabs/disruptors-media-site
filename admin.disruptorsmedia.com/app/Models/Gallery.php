<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;


    protected $table = 'gallery';
    protected $fillable = [
        'add_gallery_video',
        'gallery_link',
        'order'
    ];
}
