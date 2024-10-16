<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCollection extends Model
{
    use HasFactory;
    protected $table = 'shopcollections'; 

	protected $fillable = ['title', 'description', 'buttonText', 'buttonLink', 'imageUrl'];
}
