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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_mother');
            $table->date('date_of_birth');
            $table->string('diagnostic');
            $table->string('cpf');
            $table->string('student_id');
            $table->string('school')->nullable();
            $table->string('sige')->nullable();
            $table->string('grade_school')->nullable();
            $table->string('turn_school')->nullable();
            $table->string('class_apae');
            $table->string('turn_apae');
            $table->string('image')->nullable();
            $table->string('service');
            $table->string('state_student')->default('alive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
