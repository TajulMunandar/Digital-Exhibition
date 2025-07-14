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
        Schema::create('mentor_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projectId')->constrained('projects')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('mentorId')->constrained('mentor_projects')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_groups');
    }
};
