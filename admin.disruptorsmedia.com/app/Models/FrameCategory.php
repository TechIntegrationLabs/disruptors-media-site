<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameCategory extends Model
{
    use HasFactory;


    protected $table = 'frames_category';
    protected $fillable = [
        'frame_name',
    ];
}
