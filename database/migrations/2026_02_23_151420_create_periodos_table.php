<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('obra_id')
                ->constrained('obras')
                ->cascadeOnDelete();

            $table->smallInteger('anio');
            $table->tinyInteger('mes'); // 1..12
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->tinyInteger('estado')->default(1); // 1 abierto, 2 cerrado
            $table->timestamps();

            $table->unique(['obra_id', 'anio', 'mes']);
            $table->index('obra_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periodos');
    }
};