<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("admin_invitations", function (Blueprint $table) {
            $table->id();
            $table->string("token", 64)->unique();
            $table->foreignId("created_by")->constrained("users")->cascadeOnDelete();
            $table->timestamp("used_at")->nullable();
            $table->foreignId("used_by")->nullable()->constrained("users")->nullOnDelete();
            $table->timestamp("expires_at");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("admin_invitations");
    }
};
