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
        Schema::create('book_translatins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description');
            $table->string('images')->nullable();
            $table->string('files')->nullable();
            $table->text('content');
            $table->string('author');
            $table->string('about');
            $table->date('date');
            $table->timestamps();
        });

        Schema::dropColumns('books', [
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
            'author_oz',
            'author_uz',
            'about_oz',
            'about_uz',
            'date',
            'images',
            'files'
        ]);

        Schema::table('books', function (Blueprint $table){
            $table->string('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_translatins');
    }
};
