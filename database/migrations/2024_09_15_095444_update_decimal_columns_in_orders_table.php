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
        Schema::table('orders', function (Blueprint $table) {
            // Modifier les colonnes concernées en 'decimal'
            $table->decimal('taxe', 10, 2)->change();
            $table->decimal('order_cost', 10, 2)->change();
            $table->decimal('order_cost_ttc', 10, 2)->change();
            $table->decimal('carrier_price', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revenir au type 'integer' en cas de rollback
            $table->integer('taxe')->change();
            $table->integer('order_cost')->change();
            $table->integer('order_cost_ttc')->change();
            $table->integer('carrier_price')->change();
        });
    }
};
