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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên phim
            $table->text('description'); // Mô tả phim
            $table->integer('duration'); // Thời lượng phim (phút)
            $table->string('thumb'); // Đường dẫn ảnh thumbnail
            $table->integer('release_year'); // Năm phát hành
            $table->timestamps(); // created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
