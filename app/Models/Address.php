<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'clientName', 'street', 'codePostal', 'city', 'state', 'noreDetails', 'addressType', 'user_id'];

	public function user()
	{

		return $this->belongsTo(\App\Models\user::class);

	}

}
