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
		Schema::create('orderdetails', function (Blueprint $table) {
        	$table->id();
        	$table->string('product_name');
			$table->string('product_description');
			$table->integer('soldePrice');
			$table->integer('regularPrice');
			$table->integer('quantity');
			$table->integer('taxe');
			$table->integer('sub_total_ht');
			$table->integer('sub_total_ttc');
        	$table->timestamps();
        });

		Schema::table('orderdetails', function (Blueprint $table) {
                    $table->foreignIdFor(\App\Models\Order::class)->constrained()->onDelete('cascade');
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderdetails');
    }
};
