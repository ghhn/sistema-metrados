<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 150);
            $table->string('dni', 15)->nullable();
            $table->string('correo', 150)->unique();
            $table->string('telefono', 30)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('estado')->default(1);
            $table->tinyInteger('tipo')->default(1); // 1 admin, 2 supervisor, 3 residente, etc
            $table->timestamps();

            $table->index('dni');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};