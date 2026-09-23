<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->text('activity_description')->nullable()->after('difficulties');
            $table->boolean('activity_not_performed')->default(false)->after('activity_description');
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn([
                'activity_description',
                'activity_not_performed',
            ]);
        });
    }
};