<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['clientName', 'billig_address', 'shipping_address', 'quantity', 'taxe', 'order_cost', 'order_cost_ttc', 'isPaid', 'carrier_name', 'carrier_price', 'payment_method'];

    public function orderdetails()
    {

        return $this->hasMany(\App\Models\OrderDetails::class);

    }

    // Dans le modèle Order
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->withPivot('quantity'); // Suppose que la table pivot est nommée 'order_product' et contient la quantité
    }

}
