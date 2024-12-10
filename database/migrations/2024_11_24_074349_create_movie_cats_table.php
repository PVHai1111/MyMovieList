<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movie_cats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id'); // FK tới movies
            $table->unsignedBigInteger('cat_id'); // FK tới cats
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade'); // Cascade delete
            $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade'); // Cascade delete
            $table->timestamps(); // created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_cats');
    }
};
