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
        Schema::create('filmography_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filmography_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description', 1000);
            $table->text('content');
            $table->string('translates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filmography_translations');
    }
};
