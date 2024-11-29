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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên thành viên
            $table->date('dob'); // Ngày sinh
            $table->date('dod')->nullable(); // Ngày mất (nullable)
            $table->string('biography'); // Tiểu sử
            $table->enum('role', ['director', 'actor']); // Vai trò (enum)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
