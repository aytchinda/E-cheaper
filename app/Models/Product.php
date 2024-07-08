<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'moreDescrciption', 'additionalInfos',
        'stock', 'soldePrice', 'regularPrice', 'imageUrls', 'brand',
        'isAvailable', 'isBestSeller', 'isNewArrival', 'isFeatured', 'isSpecialOffer', 'categories'
    ];

    protected $casts = [
        'isAvailable' => 'boolean',
        'isBestSeller' => 'boolean',
        'isNewArrival' => 'boolean',
        'isFeatured' => 'boolean',
        'isSpecialOffer' => 'boolean',
        'imageUrls' => 'array',  // Cast imageUrls to array
    ];

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Category::class);
    }
}

