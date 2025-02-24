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
        Schema::create('educationals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('school');
            $table->string('age');
            $table->string('turn_school');
            $table->string('grade_school');
            $table->string('school_year');
            $table->string('professor_signature');
            $table->string('text', 10000);
            $table->string('period');
            $table->date('date_pedagogical');
            $table->unsignedBigInteger('signature_id');
            $table->foreign('signature_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educationals');
    }
};
