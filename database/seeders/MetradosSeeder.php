<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetradosSeeder extends Seeder
{
    public function run(): void
    {
        $periodo = DB::table('periodos')->where('anio', 2025)->where('mes', 10)->first();
        if (!$periodo) return;

        $periodoId = $periodo->id;

        $usuarioId = DB::table('usuarios')->where('correo', 'residente@demo.com')->value('id');
        $auditorId = DB::table('usuarios')->where('correo', 'supervisor@demo.com')->value('id');

        $partidas = DB::table('partidas')->get(['id','item','unidad_medida'])->all();
        $productoIds = DB::table('productos')->pluck('id')->all();
        $medidas = DB::table('medida_fierro')->pluck('id','codigo')->all(); // [codigo => id]

        $bloques = ['A', 'B', 'C', 'ZZ'];
        $niveles = ['N1', 'N2', 'N3', 'SS1', 'ZZ'];
        $ubicaciones = ['Ambiente 01', 'Ambiente 02', 'Pasillo', 'Patio', 'Zona de acopio', 'Taller'];

        // Simula metrados en días del 1 al 30 (como tu Excel)
        $dias = range(1, 30);

        foreach ($partidas as $partida) {
            // para no llenar demasiado: solo algunas partidas tendrán metrados diarios
            if (random_int(1, 100) > 55) continue;

            // cuántos días se registran para esta partida
            $nDias = random_int(4, 10);
            shuffle($dias);
            $diasSeleccionados = array_slice($dias, 0, $nDias);

            foreach ($diasSeleccionados as $d) {
                $fecha = sprintf('2025-10-%02d', $d);

                // si quieres permitir varios registros mismo día:
                $correlativo = 1;

                $cantidadTotal = round(random_int(10, 800) / 10, 3); // 1.0 .. 80.0

                $estadoAprob = [1,2,2,3,4][array_rand([1,2,2,3,4])];

                $diariaId = DB::table('partida_diarias')->insertGetId([
                    'partida_id' => $partida->id,
                    'periodo_id' => $periodoId,
                    'correlativo' => $correlativo,
                    'fecha' => $fecha,
                    'cantidad_total' => $cantidadTotal,
                    'adjunto' => null,
                    'usuario_id' => $usuarioId,

                    'estado_aprobacion' => $estadoAprob,
                    'auditado_por' => in_array($estadoAprob, [3,4]) ? $auditorId : null,
                    'auditado_en' => in_array($estadoAprob, [3,4]) ? now() : null,
                    'observacion' => in_array($estadoAprob, [3]) ? 'Observado: verificar sustento' : null,

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Crea 1 a 3 líneas (bienes)
                $nLineas = random_int(1, 3);
                $restante = $cantidadTotal;

                for ($i = 1; $i <= $nLineas; $i++) {
                    $parcial = ($i === $nLineas)
                        ? $restante
                        : round(max(0.1, $restante * (random_int(20, 60) / 100)), 3);

                    $restante = round($restante - $parcial, 3);

                    $productoId = $productoIds ? $productoIds[array_rand($productoIds)] : null;

                    // Dimensiones opcionales (si UND es m2/m3)
                    $long = null; $ancho = null; $altura = null; $nVeces = 1;

                    $und = strtolower((string)$partida->unidad_medida);
                    if (in_array($und, ['m2','m²'])) {
                        $long = round(random_int(10, 400)/100, 3);   // 0.10..4.00
                        $ancho = round(random_int(10, 400)/100, 3);
                        $nVeces = random_int(1, 4);
                        $parcial = round($long * $ancho * $nVeces, 3);
                    } elseif ($und === 'm3') {
                        $long = round(random_int(10, 400)/100, 3);
                        $ancho = round(random_int(10, 400)/100, 3);
                        $altura = round(random_int(10, 300)/100, 3);
                        $nVeces = random_int(1, 3);
                        $parcial = round($long * $ancho * $altura * $nVeces, 3);
                    }

                    $bienId = DB::table('partida_bien_id')->insertGetId([
                        'partida_diaria_id' => $diariaId,
                        'producto_id' => $productoId,

                        'cantidad' => $parcial,      // línea
                        'longitud' => $long,
                        'ancho' => $ancho,
                        'altura' => $altura,
                        'n_veces' => $nVeces,

                        'total' => $parcial,
                        'observacion' => null,

                        'ubicacion' => $ubicaciones[array_rand($ubicaciones)],
                        'bloque' => $bloques[array_rand($bloques)],
                        'nivel' => $niveles[array_rand($niveles)],

                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Fierro: solo para algunas líneas (por ejemplo cuando el ítem suele ser “acero”)
                    $probFierro = (str_contains(strtolower($partida->item), '3.1') || $und === 'kg') ? 65 : 20;
                    if (random_int(1, 100) <= $probFierro && count($medidas) > 0) {
                        $codigos = array_keys($medidas);
                        shuffle($codigos);
                        $usar = array_slice($codigos, 0, random_int(1, 3)); // 1 a 3 medidas

                        foreach ($usar as $codigo) {
                            DB::table('partida_fierros')->insert([
                                'partida_bien_id' => $bienId,
                                'medida_fierro_id' => $medidas[$codigo],
                                'cantidad' => round(random_int(0, 200) / 10, 3), // 0..20
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        }

        // (Opcional) actualizar periodo_partida al cierre
        // Aquí lo dejas abierto; si quieres, luego al “cerrar periodo” recalculas y llenas acumulados.
    }
}