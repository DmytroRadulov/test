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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status',['published','moderation'])->default('moderation');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('genre_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained('movies', 'id')->cascadeOnDelete();
            $table->foreignId('genre_id')->constrained('genres', 'id')->cascadeOnDelete();
            $table->unique(['movie_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
        Schema::dropIfExists('genre_movie');
    }
};
