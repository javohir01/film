<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('film_analyses', function (Blueprint $table){
            $table->string('slug');
            $table->bigInteger('order');
        });
        Schema::table('film_analyses', function (Blueprint $table){
            $table->dropColumn([
               'name_oz',
               'name_uz',
               'name_ru',
               'name_en',
               'description_oz',
               'description_uz',
               'description_ru',
               'description_en',
               'content_oz',
               'content_uz',
               'content_ru',
               'content_en',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
