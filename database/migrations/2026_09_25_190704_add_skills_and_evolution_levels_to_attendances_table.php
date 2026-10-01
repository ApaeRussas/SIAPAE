<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adiciona habilidades, evolução das habilidades
     * e níveis quantitativos de avanços e dificuldades.
     */
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {

            /*
             * Habilidades trabalhadas/observadas
             */
            $table->text('skills')
                ->nullable()
                ->after('educational_axis');

            /*
             * Evolução das habilidades
             */
            $table->text('skills_evolution')
                ->nullable()
                ->after('skills');

            /*
             * Nível de evolução dos avanços.
             *
             * 1 = Quase nada
             * 2 = Muito pouco
             * 3 = Pouco
             * 4 = Bom
             * 5 = Excelente
             */
            $table->unsignedTinyInteger('advances_level')
                ->nullable()
                ->after('advances');

            /*
             * Nível das dificuldades observadas.
             *
             * 1 = Quase nada
             * 2 = Muito pouco
             * 3 = Pouco
             * 4 = Bom
             * 5 = Excelente
             *
             * O mesmo padrão será usado na interface.
             */
            $table->unsignedTinyInteger('difficulties_level')
                ->nullable()
                ->after('difficulties');
        });
    }

    /**
     * Remove os campos adicionados.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {

            $table->dropColumn([
                'skills',
                'skills_evolution',
                'advances_level',
                'difficulties_level',
            ]);

        });
    }
};
