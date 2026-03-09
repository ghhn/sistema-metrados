<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('medida_fierro', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique(); // 1/4", 3/8", etc
            $table->string('detalle', 255)->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medida_fierro');
    }
};