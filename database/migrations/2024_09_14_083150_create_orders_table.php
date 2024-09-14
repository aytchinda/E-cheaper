<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
		Schema::create('orders', function (Blueprint $table) {
        	$table->id();
        	$table->string('clientName');
			$table->string('billing_address');
			$table->string('shipping_address');
			$table->integer('quantity');
			$table->integer('taxe');
			$table->integer('order_cost');
			$table->integer('order_cost_ttc');
			$table->boolean('isPaid')->default(false);
			$table->string('carrier_name');
			$table->integer('carrier_price');
			$table->string('payment_method');
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
