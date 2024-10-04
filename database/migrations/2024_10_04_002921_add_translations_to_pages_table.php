<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTranslationsToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_fr')->nullable()->after('title_en');
            $table->string('title_es')->nullable()->after('title_fr');

            $table->text('content_en')->nullable()->after('content');
            $table->text('content_fr')->nullable()->after('content_en');
            $table->text('content_es')->nullable()->after('content_fr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'title_fr', 'title_es', 'content_en', 'content_fr', 'content_es']);
        });
    }
}
