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
        Schema::create('mentor_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentorId')->constrained('mentors')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('kategoriId')->constrained('kategori_projects')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('userId')->constrained('users')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_projects');
    }
};
