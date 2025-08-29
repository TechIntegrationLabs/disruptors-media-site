<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteMeta extends Model
{
    use HasFactory;
    
     protected $table = 'page_meta';
    protected $fillable = [
        'home_meta_title',
        'home_meta_description',
        'work_meta_title',
        'work_meta_description',
        'services_meta_title',
        'services_meta_description',
        'about_meta_title',
        'about_meta_description',
        'gallery_meta_title',
        'gallery_meta_description',
        'faq_meta_title',
        'faq_meta_description',
        'contact_meta_title',
        'contact_meta_description',
         'podcast_meta_title',
        'podcast_meta_description'
    ];
}
