<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('partida_bienes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('partida_diaria_id')
                ->constrained('partida_diarias')
                ->cascadeOnDelete();

            $table->foreignId('producto_id')
                ->nullable()
                ->constrained('productos')
                ->nullOnDelete();

            $table->decimal('cantidad', 12, 3)->default(0);
            $table->decimal('longitud', 12, 3)->nullable();
            $table->decimal('ancho', 12, 3)->nullable();
            $table->decimal('altura', 12, 3)->nullable();
            $table->decimal('n_veces', 12, 3)->default(1);

            $table->decimal('total', 12, 3)->default(0);
            $table->string('observacion', 255)->nullable();

            $table->string('ubicacion', 255)->nullable();
            $table->string('bloque', 100)->nullable();
            $table->string('nivel', 100)->nullable();

            $table->timestamps();

            $table->index('partida_diaria_id');
            $table->index('producto_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partida_bienes');
    }
};