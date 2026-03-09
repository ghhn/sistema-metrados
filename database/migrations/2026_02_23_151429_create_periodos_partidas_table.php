<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periodo_partida', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periodo_id')
                ->constrained('periodos')
                ->cascadeOnDelete();

            $table->foreignId('partida_id')
                ->constrained('partidas')
                ->cascadeOnDelete();

            $table->decimal('anterior_acumulado', 12, 3)->default(0);
            $table->decimal('acumulado_al_cierre', 12, 3)->default(0);
            $table->decimal('saldo_al_cierre', 12, 3)->default(0);

            $table->tinyInteger('estado_aprobacion')->default(1); // 1 borrador, 2 enviado, 3 observado, 4 aprobado

            $table->foreignId('auditado_por')
                ->nullable()
                ->constrained('usuarios')
                ->nullOnDelete();

            $table->dateTime('auditado_en')->nullable();
            $table->text('observacion')->nullable();

            $table->timestamps();

            $table->unique(['periodo_id', 'partida_id']);
            $table->index('partida_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periodo_partida');
    }
};