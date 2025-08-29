<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuManager extends Model
{
    use HasFactory;


    protected $table = 'menu_manager';
    protected $fillable = [
        'category_id',
        'menu_name',
        'menu_link',
        'order'
    ];
}
