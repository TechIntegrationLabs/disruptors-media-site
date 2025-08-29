<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetAQuote extends Model
{
    use HasFactory;

    protected $table = 'get_a_quote';
    protected $fillable = [
        'main_heading',
        'right_side_content',
        'anchor_text',
        'anchor_link'
    
    ];
}
