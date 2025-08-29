<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatwedo extends Model
{
    use HasFactory;

    protected $table = 'who_we_do';
    protected $fillable = [
        'featured_image',
        'main_heading',
        'excerpt',
        'category_id',
        'feature_video',
        'enter_link',
        'order'
    ];
}
