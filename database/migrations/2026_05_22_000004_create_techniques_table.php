<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('techniques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name_viet');
            $table->string('name_ro');
            $table->enum('type', ['simple', 'form'])->default('simple');
            $table->text('description')->nullable();
            $table->json('key_points')->nullable();  // ["punct 1", "punct 2"]
            $table->text('coach_note')->nullable();
            $table->string('video_url')->nullable();  // YouTube URL sau storage path
            $table->json('steps')->nullable();         // doar pentru type = form
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('techniques');
    }
};
