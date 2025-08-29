<?php

namespace App\Models;
use App\Models\Portfolio_Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porfolios extends Model
{
    use HasFactory;

    protected $table = 'portfolios';
    protected $fillable = [
        'category_id',
        'portfolio_name',
        'portfolio_slug',
        'portfolio_image',
        'overview_description',
        'team_description',
        'portfolio_tags',
        'order'
    ];


    // public function images()
    // {
    //     return $this->hasMany(Portfolio_Images::class);
    // }
    public function images()
    {
        return $this->hasMany(Portfolio_Images::class, 'portfolio_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Portfolio_Category::class, 'category_id', 'id');
    }
}
