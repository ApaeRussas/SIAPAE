
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $indexes = DB::select("SHOW INDEX FROM attendances");

        // Verifica se já existe algum índice comum na coluna student_id,
        // independentemente do nome utilizado pelo banco.
        $hasStudentIndex = collect($indexes)->contains(
            fn ($index) =>
                $index->Column_name === 'student_id'
                && (int) $index->Non_unique === 1
        );

        $hasUniqueIndex = collect($indexes)->contains(
            fn ($index) =>
                $index->Key_name === 'attendances_student_professor_date_unique'
        );

        // Garante um índice comum para student_id.
        if (!$hasStudentIndex) {
            Schema::table('attendances', function (Blueprint $table) {
                $table->index('student_id', 'attendances_student_id_index');
            });
        }

        // Remove a restrição que impedia vários atendimentos no mesmo dia.
        if ($hasUniqueIndex) {
            Schema::table('attendances', function (Blueprint $table) {
                $table->dropUnique('attendances_student_professor_date_unique');
            });
        }
    }

    public function down(): void
    {
        // Não recriar a restrição de unicidade.
    }
};
