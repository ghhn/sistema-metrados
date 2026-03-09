<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->delete();
        DB::statement('ALTER TABLE productos AUTO_INCREMENT = 1');

        // Basado en nombres típicos encontrados en tu Excel PN (ARENA FINA, PIEDRA CHANCADA, etc.)
        $base = [
            ['nombre' => 'ARENA FINA', 'codigo' => 'MAT-ARENA-FINA', 'unidad_medida' => 'm3'],
            ['nombre' => 'ARENA GRUESA', 'codigo' => 'MAT-ARENA-GRU', 'unidad_medida' => 'm3'],
            ['nombre' => 'PIEDRA CHANCADA', 'codigo' => 'MAT-PIEDRA-CHA', 'unidad_medida' => 'm3'],
            ['nombre' => 'MATERIAL DE RELLENO', 'codigo' => 'MAT-RELLENO', 'unidad_medida' => 'm3'],
            ['nombre' => 'CEMENTO', 'codigo' => 'MAT-CEMENTO', 'unidad_medida' => 'kg'],
            ['nombre' => 'CONCRETO', 'codigo' => 'MAT-CONCRETO', 'unidad_medida' => 'm3'],
            ['nombre' => 'ALAMBRE N° 16', 'codigo' => 'MAT-ALAMBRE-16', 'unidad_medida' => 'kg'],
            ['nombre' => 'ALAMBRE N° 8', 'codigo' => 'MAT-ALAMBRE-08', 'unidad_medida' => 'kg'],
            ['nombre' => 'MADERAS USADAS', 'codigo' => 'MAT-MADERA-USA', 'unidad_medida' => 'und'],
            ['nombre' => 'MATERIALES VARIOS', 'codigo' => 'MAT-VARIOS', 'unidad_medida' => 'und'],
        ];

        $rows = [];
        foreach ($base as $p) {
            $rows[] = [
                'nombre' => $p['nombre'],
                'codigo' => $p['codigo'],
                'unidad_medida' => $p['unidad_medida'],
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // algunos productos adicionales para variar
        for ($i = 1; $i <= 10; $i++) {
            $rows[] = [
                'nombre' => "PRODUCTO DEMO {$i}",
                'codigo' => "PRD-DEMO-{$i}",
                'unidad_medida' => ['und', 'kg', 'm3', 'm2'][array_rand(['und', 'kg', 'm3', 'm2'])],
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('productos')->insert($rows);
    }
}
