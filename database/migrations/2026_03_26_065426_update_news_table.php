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
        Schema::table('news', function (Blueprint $table){
            $table->dropColumn([
               'name_uz',
               'name_ru',
               'name_en',
               'name_oz',
               'description_uz',
               'description_ru',
               'description_en',
               'description_oz',
                'content_uz',
                'content_ru',
                'content_en',
                'content_oz'
            ]);

            $table->string('slug')->nullable()->after('id');

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
