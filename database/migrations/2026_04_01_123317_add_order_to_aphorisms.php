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
        Schema::table('aphorisms', function (Blueprint $table) {
            $table->bigInteger('order')->default(0);
            $table->string('slug')->after('images');
            $table->dropColumn([
                'full_name_oz',
                'full_name_uz',
                'full_name_ru',
                'full_name_en',
                'description_oz',
                'description_uz',
                'description_ru',
                'description_en',
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
        Schema::table('aphorisms', function (Blueprint $table) {
            //
        });
    }
};
