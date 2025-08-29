<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureClients extends Model
{
    use HasFactory;


    protected $table = 'featured_clients';
    protected $fillable = [
        'add_feature_clients',
        'featured_link',
        'order'
    
    ];
}
