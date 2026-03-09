<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('obra_usuario', function (Blueprint $table) {
            $table->id();

            $table->foreignId('obra_id')
                ->constrained('obras')
                ->cascadeOnDelete();

            $table->foreignId('usuario_id')
                ->constrained('usuarios')
                ->cascadeOnDelete();

            $table->tinyInteger('rol')->default(1); // 1 residente, 2 supervisor, etc (según tu lógica)
            $table->tinyInteger('estado')->default(1);

            $table->timestamps();

            $table->unique(['obra_id', 'usuario_id']);
            $table->index(['usuario_id', 'obra_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obra_usuario');
    }
};