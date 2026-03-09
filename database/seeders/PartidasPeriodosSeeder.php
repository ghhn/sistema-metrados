<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartidasPeriodosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('periodo_partida')->delete();
        DB::table('partida_diarias')->delete();
        DB::table('partida_bienes')->delete();
        DB::table('partida_fierros')->delete();
        DB::table('periodos')->delete();
        DB::table('partidas')->delete();

        $json = file_get_contents(database_path('data/partidas.json'));
        $partidas = json_decode($json, true);
        dd($partidas);

        $obraId = DB::table('obras')->value('id');
        $responsableId = DB::table('usuarios')
            ->where('correo', 'residente@demo.com')
            ->value('id');

        $periodoId = DB::table('periodos')->insertGetId([
            'obra_id' => $obraId,
            'anio' => 2025,
            'mes' => 10,
            'fecha_inicio' => '2025-10-01',
            'fecha_fin' => '2025-10-31',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


       
        foreach ($partidas as $p) {

            $partidaId = DB::table('partidas')->insertGetId([
                'obra_id' => $obraId,
                'item' => $p['codigo'],  
                'descripcion' => $p['descripcion'],
                'unidad_medida' => $p['unidad_medida'],
                'metrado_contrato' => $p['metrado_contrato'],
                'responsable_id' => $responsableId,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $acum = $p['ant'] ?? 0;
            $metrado = $p['metrado_contrato'] ?? 0;
            $saldo = max(0, $p['metrado_contrato'] - $acum);

            DB::table('periodo_partida')->insert([
                'periodo_id' => $periodoId,
                'partida_id' => $partidaId,
                'anterior_acumulado' => $acum,
                'acumulado_al_cierre' => $acum,
                'saldo_al_cierre' => $saldo,
                'estado_aprobacion' => 1,
                'auditado_por' => null,
                'auditado_en' => null,
                'observacion' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}