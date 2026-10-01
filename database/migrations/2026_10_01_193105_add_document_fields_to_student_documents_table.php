<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_documents', function (Blueprint $table) {
            $table->foreignId('uploaded_by')
                ->after('student_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('title')
                ->after('document_type');

            $table->text('description')
                ->nullable()
                ->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('student_documents', function (Blueprint $table) {
            $table->dropForeign(['uploaded_by']);
            $table->dropColumn([
                'uploaded_by',
                'title',
                'description',
            ]);
        });
    }
};