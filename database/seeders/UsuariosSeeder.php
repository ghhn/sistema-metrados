<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->delete();
        DB::statement('ALTER TABLE usuarios AUTO_INCREMENT = 1');

        $usuarios = [
            [
                'nombres' => 'Admin Sistema',
                'dni' => '00000000',
                'correo' => 'admin@demo.com',
                'telefono' => '999999999',
                'password' => Hash::make('123456'),
                'estado' => 1,
                'tipo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombres' => 'Supervisor Obra',
                'dni' => '11111111',
                'correo' => 'supervisor@demo.com',
                'telefono' => '988888888',
                'password' => Hash::make('123456'),
                'estado' => 1,
                'tipo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombres' => 'Residente Obra',
                'dni' => '22222222',
                'correo' => 'residente@demo.com',
                'telefono' => '977777777',
                'password' => Hash::make('123456'),
                'estado' => 1,
                'tipo' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // usuarios extra
        for ($i = 1; $i <= 7; $i++) {
            $usuarios[] = [
                'nombres' => "Usuario Demo {$i}",
                'dni' => str_pad((string) random_int(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                'correo' => "user{$i}@demo.com",
                'telefono' => '9'.random_int(10000000, 99999999),
                'password' => Hash::make('123456'),
                'estado' => 1,
                'tipo' => random_int(2, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('usuarios')->insert($usuarios);
    }
}
