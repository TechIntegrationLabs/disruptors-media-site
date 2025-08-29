<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoModel extends Model
{
    use HasFactory;
    
     protected $table = 'seo_scripts';
    protected $fillable = [
        'google_search_console',
        'google_analytics',
       
    ];
}
