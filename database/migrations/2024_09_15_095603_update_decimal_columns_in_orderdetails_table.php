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
        Schema::table('orderdetails', function (Blueprint $table) {
            // Modifier les colonnes concernées en 'decimal'
            $table->decimal('soldePrice', 10, 2)->change();
            $table->decimal('regularPrice', 10, 2)->change();
            $table->decimal('taxe', 10, 2)->change();
            $table->decimal('sub_total_ht', 10, 2)->change();
            $table->decimal('sub_total_ttc', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orderdetails', function (Blueprint $table) {
            // Revenir au type 'integer' en cas de rollback
            $table->integer('soldePrice')->change();
            $table->integer('regularPrice')->change();
            $table->integer('taxe')->change();
            $table->integer('sub_total_ht')->change();
            $table->integer('sub_total_ttc')->change();
        });
    }
};
