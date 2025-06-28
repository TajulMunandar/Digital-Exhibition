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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nama_group');
            $table->string('sesi_kelas');
            $table->foreignId('kategoriId')->constrained('kategori_projects')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('userId')->constrained('users')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_product');
            $table->text('deskripsi');
            $table->string('thumbnail')->nullable();
            $table->string('slug')->unique();
            $table->text('link_video');
            $table->text('link_figma');
            $table->text('link_website');
            $table->boolean('is_best');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
