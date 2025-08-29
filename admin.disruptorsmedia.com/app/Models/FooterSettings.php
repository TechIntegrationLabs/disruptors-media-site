<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSettings extends Model
{
    use HasFactory;


    protected $table = 'footer_settings';
    protected $fillable = [
        'left_side_heading',
        'left_side_address',
        'right_side_address',
    
    ];
}
