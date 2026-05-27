<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->after('title');
            $table->date('registration_deadline')->nullable()->after('location');
        });

        Schema::table('stage_enrollments', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('user_id');
            $table->text('admin_note')->nullable()->after('status');
        });

        Schema::table('exams', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->foreignId('grade_id')->nullable()->constrained('grades')->nullOnDelete()->after('title');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->after('grade_id');
        });

        Schema::table('exam_enrollments', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('user_id');
            $table->boolean('had_stage_last_year')->default(false)->after('status');
            $table->string('result')->nullable()->after('had_stage_last_year');
            $table->text('admin_note')->nullable()->after('result');
        });
    }

    public function down(): void
    {
        Schema::table('exam_enrollments', function (Blueprint $table) {
            $table->dropColumn(['status', 'had_stage_last_year', 'result', 'admin_note']);
        });
        Schema::table('exams', function (Blueprint $table) {
            $table->dropForeign(['grade_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['title', 'grade_id', 'created_by']);
        });
        Schema::table('stage_enrollments', function (Blueprint $table) {
            $table->dropColumn(['status', 'admin_note']);
        });
        Schema::table('stages', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn(['title', 'created_by', 'registration_deadline']);
        });
    }
};
