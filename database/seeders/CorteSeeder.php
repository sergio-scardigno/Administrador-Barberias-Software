<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CorteSeeder extends Seeder
{
    /**
     * Ejecuta los seeders de la base de datos.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Corte::factory(50)->create(); // Crea 50 registros de corte
    }
}
