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
		Schema::create('methods', function (Blueprint $table) {
        	$table->id();
        	$table->string('name');
			$table->string('description');
			$table->string('moreDescription')->nullable();
			$table->string('imageUrl');
			$table->string('test_public_key');
			$table->string('test_private_key');
			$table->string('prod_public_key')->nullable();
			$table->string('pro_private_key')->nullable();
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('methods');
    }
};
