<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('current_grade_id')
                  ->nullable()
                  ->constrained('grades')
                  ->nullOnDelete()
                  ->after('is_owner');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\User::class, 'current_grade_id');
            $table->dropColumn('current_grade_id');
        });
    }
};
