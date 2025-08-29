<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioGallery extends Model
{
    use HasFactory;

protected $table = "galleries";
    protected $fillable = [
        'studio_id',
        'image', // Field to store the gallery image path or URL
    ];



    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
