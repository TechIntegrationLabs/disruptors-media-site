<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageSettings extends Model
{
    use HasFactory;



    protected $table = 'homepage_settings';
    protected $fillable = [
        'section_one_main_heading',
        'section_one_sub_heading',
        'section_one_button_text',
        'section_one_button_link',
        'section_two_box_text',
        'section_three_main_heading',
        'section_four_main_heading'
    ];
}
