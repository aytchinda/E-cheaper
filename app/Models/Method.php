<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'description', 'moreDescritption', 'imageUrl', 'test_public_key', 'test_private_key', 'prod_public_key', 'pro_private_key'];
}
