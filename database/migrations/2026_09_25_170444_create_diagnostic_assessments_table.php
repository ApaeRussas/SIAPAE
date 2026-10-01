```php
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
        Schema::create('diagnostic_assessments', function (Blueprint $table) {
            $table->id();

            // Identificação
            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->unsignedInteger('age')->nullable();

            $table->string('series')->nullable();

            $table->string('school')->nullable();

            $table->string('cid')->nullable();

            $table->date('date');

            /*
             * Cada eixo da sondagem será armazenado em JSON.
             * Isso permite guardar todos os itens de cada eixo
             * sem criar dezenas de colunas na tabela.
             */

            // Eixo: Linguagem
            $table->json('language')->nullable();

            // Eixo: Lógico Matemático
            $table->json('logical_mathematical')->nullable();

            // Eixo: Vida Funcional - AVD's e AVP's
            $table->json('functional_life')->nullable();

            // Eixo: Vivência Corporal
            $table->json('body_experience')->nullable();

            // Eixo: Natureza e Sociedade
            $table->json('nature_society')->nullable();

            // Eixo: Informática Pedagógica
            $table->json('educational_informatics')->nullable();

            // Eixo: Cognitivo
            $table->json('cognitive')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_assessments');
    }
};