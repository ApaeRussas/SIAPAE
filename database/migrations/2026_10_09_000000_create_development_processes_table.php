<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('development_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('evaluation_date')->nullable();
            $table->json('responses')->nullable();
            $table->longText('observations')->nullable();
            $table->longText('family_guidance')->nullable();
            $table->string('teacher_signature')->nullable();
            $table->string('coordination_signature')->nullable();
            $table->timestamps();
            $table->index(['student_id', 'evaluation_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('development_processes');
    }
};
