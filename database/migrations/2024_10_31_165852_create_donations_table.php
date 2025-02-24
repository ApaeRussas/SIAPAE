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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('Jan')->nullable();
            $table->string('Fev')->nullable();
            $table->string('Mar')->nullable();
            $table->string('Abr')->nullable();
            $table->string('Mai')->nullable();
            $table->string('Jun')->nullable();
            $table->string('Jul')->nullable();
            $table->string('Ago')->nullable();
            $table->string('Set')->nullable();
            $table->string('Out')->nullable();
            $table->string('Nov')->nullable();
            $table->string('Dez')->nullable();
            $table->integer('year_of_donation')->default(\Carbon\Carbon::now()->year);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
