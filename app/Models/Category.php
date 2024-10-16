<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'slug', 'description', 'imageUrl', 'isMega'];

	public function products()
	{

		return $this->belongsToMany(\App\Models\Product::class,'category_product');

	}

}
