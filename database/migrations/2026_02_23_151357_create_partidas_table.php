<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('obra_id')
                ->constrained('obras')
                ->cascadeOnDelete();

            $table->string('item', 50);
            $table->text('descripcion');
            $table->string('unidad_medida', 10);

            $table->decimal('metrado_contrato', 12, 3)->default(0);

            $table->foreignId('responsable_id')
                ->nullable()
                ->constrained('usuarios')
                ->nullOnDelete();

            $table->tinyInteger('estado')->default(1);
            $table->timestamps();

            $table->unique(['obra_id', 'item']);
            $table->index('obra_id');
            $table->index('responsable_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partidas');
    }
};