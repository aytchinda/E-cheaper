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
		Schema::create('addresses', function (Blueprint $table) {
        	$table->id();
        	$table->string('name');
			$table->string('clientName');
			$table->string('street');
			$table->string('codePostal');
			$table->string('city');
			$table->string('state');
			$table->string('noreDetails')->nullable();
			$table->string('addressType');
        	$table->timestamps();
        });

		Schema::table('addresses', function (Blueprint $table) {
                    $table->foreignIdFor(\App\Models\user::class)->constrained()->onDelete('cascade');
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
