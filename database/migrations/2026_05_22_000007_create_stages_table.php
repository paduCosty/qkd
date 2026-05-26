<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('instructor')->nullable();
            $table->timestamps();
        });

        Schema::create('stage_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stage_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['stage_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stage_enrollments');
        Schema::dropIfExists('stages');
    }
};
