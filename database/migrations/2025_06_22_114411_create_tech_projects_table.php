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
        Schema::create('tech_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('techId')->constrained('teches')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('projectId')->constrained('projects')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tech_projects');
    }
};
