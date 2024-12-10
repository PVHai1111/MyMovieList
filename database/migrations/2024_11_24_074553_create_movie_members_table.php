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
        Schema::create('movie_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id'); // FK tới movies
            $table->unsignedBigInteger('member_id'); // FK tới members
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_members');
    }
};
