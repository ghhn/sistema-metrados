<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObrasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('obra_usuario')->delete();
        DB::table('obras')->delete();

        // Basado en el encabezado del Excel
        $obraId = DB::table('obras')->insertGetId([
            'nombre' => 'MEJORAMIENTO Y AMPLIACION DE LOS SERVICIOS DE SALUD DEL ESTABLECIMIENTO DE SALUD DE BELEMPAMPA - HOSPITAL',
            'meta' => '160-2025',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $adminId = DB::table('usuarios')->where('correo', 'admin@demo.com')->value('id');
        $supId   = DB::table('usuarios')->where('correo', 'supervisor@demo.com')->value('id');
        $resId   = DB::table('usuarios')->where('correo', 'residente@demo.com')->value('id');

        // roles (tinyint): 1 residente, 2 supervisor, 9 admin obra (ejemplo)
        DB::table('obra_usuario')->insert([
            [
                'obra_id' => $obraId,
                'usuario_id' => $adminId,
                'rol' => 9,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'obra_id' => $obraId,
                'usuario_id' => $supId,
                'rol' => 2,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'obra_id' => $obraId,
                'usuario_id' => $resId,
                'rol' => 1,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}