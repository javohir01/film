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
        Schema::create('film_analysis_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_analysis_id')->index()->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description', 1000);
            $table->text('content');
            $table->string('translates')->index();
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
        Schema::dropIfExists('film_analysis_translations');
    }
};
