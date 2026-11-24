<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // A regra de unicidade foi cancelada.
        // Um professor pode cadastrar vários atendimentos
        // para o mesmo aluno na mesma data.
    }

    public function down(): void
    {
        // Não recriar a regra de unicidade.
    }
};
