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
        Schema::create('primiere_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('premiere_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->longText('description');
            $table->text('content');
            $table->string('translates');
            $table->timestamps();
        });

        Schema::table('premieres', function (Blueprint $table){
            $table->string('slug');
        });

        Schema::dropColumns('premieres', [
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('primiere_translations');
    }
};
