<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;


    protected $fillable = [
        'studio_title',
        'location',
        'feature_image',
        'about_content',
        'pricing_text',
        'booking_action_link',
        'message_us_link',
    ];



    public function galleries()
    {
        return $this->hasMany(StudioGallery::class);
    }
}
