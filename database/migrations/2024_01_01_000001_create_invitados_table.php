<?php
// database/migrations/2024_01_01_000001_create_invitados_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('email', 100)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('documento_id', 50)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitados');
    }
};