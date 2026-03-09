<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('partida_diarias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('partida_id')
                ->constrained('partidas')
                ->cascadeOnDelete();

            $table->foreignId('periodo_id')
                ->constrained('periodos')
                ->cascadeOnDelete();

            $table->integer('correlativo')->default(1);
            $table->date('fecha');

            $table->decimal('cantidad_total', 12, 3)->default(0);
            $table->string('adjunto', 255)->nullable();

            $table->foreignId('usuario_id')
                ->constrained('usuarios')
                ->restrictOnDelete(); // evita borrar usuario si tiene registros

            $table->tinyInteger('estado_aprobacion')->default(1);

            $table->foreignId('auditado_por')
                ->nullable()
                ->constrained('usuarios')
                ->nullOnDelete();

            $table->dateTime('auditado_en')->nullable();
            $table->text('observacion')->nullable();

            $table->timestamps();

            $table->unique(['partida_id', 'fecha', 'correlativo']);
            $table->index(['partida_id', 'fecha']);
            $table->index(['periodo_id', 'fecha']);
            $table->index('usuario_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partida_diarias');
    }
};