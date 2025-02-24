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
        Schema::create('frequencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('class_apae');
            $table->string('turn_apae');
            $table->string('month_year');
            $table->string('observation', 750)->nullable(); 
            $table->unsignedBigInteger('signature_id')->nullable();
            $table->foreign('signature_id')->references('id')->on('users')->onDelete('set null');
            for ($i = 1; $i <= 31; $i++) { 
                $table->boolean((string)$i)->nullable(); 
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequencies');
    }
};
