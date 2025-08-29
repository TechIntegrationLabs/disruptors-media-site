<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_logo',
        'header_right_side_anchor_text',
        'start_time',
        'header_right_side_anchor_link',
    ];
}
