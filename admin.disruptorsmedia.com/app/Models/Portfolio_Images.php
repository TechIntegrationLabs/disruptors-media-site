<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio_Images extends Model
{
    use HasFactory;

    protected $table = 'portfolio_images';
    protected $fillable = [
        'portfolio_id',
        'portfolio_images',
    ];
}
