<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedidaFierroSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('medida_fierro')->delete();

        // Basado en el encabezado del Excel: 1/4", 3/8", 1/2", 5/8", 3/4", 1"
        $medidas = ['1/4"', '3/8"', '1/2"', '5/8"', '3/4"', '1"'];

        $rows = [];
        foreach ($medidas as $m) {
            $rows[] = [
                'codigo' => $m,
                'detalle' => "Barra corrugada {$m}",
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('medida_fierro')->insert($rows);
    }
}