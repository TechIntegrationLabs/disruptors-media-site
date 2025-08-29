<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesPage extends Model
{
    use HasFactory;


    protected $table = 'services_page';
    protected $fillable = [
        'services_page_main_heading',
        'services_page_box_inner_image',
        'services_page_box_inner_content',
        'services_page_second_section_main_heading',
        'services_page_second_section_main_content'

    ];
}
