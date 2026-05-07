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
        Schema::create('aphorism_translations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->index();
            $table->string('description', 1000);
            $table->jsonb('calendar');
            $table->string('translates', 2)->index();
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
        Schema::dropIfExists('aphorism_translations');
    }
};
