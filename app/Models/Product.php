<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'moreDescrciption', 'additionalInfos', 'stock', 'soldePrice', 'regularPrice', 'imageUrls', 'brand', 'isAvailable', 'isBestSeller', 'isNewArrival', 'isFeatured', 'isSpecialOffer', 'categories'];


	public function categories()
	{

		return $this->belongsToMany(\App\Models\Category::class);

	}


}
