<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'orderdetails'; // Indiquer explicitement le nom de la table


	public function order()
	{

		return $this->belongsTo(\App\Models\Order::class);

	}


	protected $fillable = ['product_name', 'product_description', 'soldePrice', 'regularPrice', 'quantity', 'taxe', 'sub_total_ht', 'sub_total_ttc', 'order'];
}
