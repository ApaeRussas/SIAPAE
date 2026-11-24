<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ATENÇÃO: se já existirem registros duplicados (mesmo aluno + professor + data),
        // remova-os antes de rodar, senão a migration falha.
        Schema::table('attendances', function (Blueprint $table) {
            $table->unique(
                ['student_id', 'signature_id', 'date'],
                'attendances_student_professor_date_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropUnique('attendances_student_professor_date_unique');
        });
    }
};