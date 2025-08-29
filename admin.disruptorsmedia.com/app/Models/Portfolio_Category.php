<?php

namespace App\Models;
use App\Models\Porfolios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio_Category extends Model
{
    use HasFactory;

    protected $table = 'portfolio_category';
    protected $fillable = [
        'category_name',
    ];


    public function portfolios()
    {
        return $this->hasMany(Porfolios::class, 'category_id', 'id');
    }
}
