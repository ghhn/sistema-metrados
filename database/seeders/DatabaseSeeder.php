<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsuariosSeeder::class,
            ObrasSeeder::class,
            ProductosSeeder::class,
            MedidaFierroSeeder::class,
            PartidasPeriodosSeeder::class,
            MetradosSeeder::class,
        ]);
    }
}