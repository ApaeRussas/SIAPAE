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
        Schema::create('scfvs', function (Blueprint $table) {
            $table->id();
            $table->string('theme');
            // 1ª Quinzena
            $table->string('1Q_objective', 512);
            $table->string('1Q_activity', 512);
            $table->string('1Q_description', 1024);
            $table->string('1Q_resource', 512);
            $table->string('1Q_partner', 512);
            $table->date('1Q_date');
            $table->string('1Q_place');
            // 2ª Quinzena
            $table->string('2Q_objective', 512);
            $table->string('2Q_activity', 512);
            $table->string('2Q_description', 1024);
            $table->string('2Q_resource', 512);
            $table->string('2Q_partner', 512);
            $table->date('2Q_date');
            $table->string('2Q_place');
            $table->string('students_frequency', 1024);
            $table->unsignedBigInteger('signature_id');
            $table->foreign('signature_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('date_scfv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scfvs');
    }
};
