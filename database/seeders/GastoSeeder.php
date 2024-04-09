<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gasto;


class GastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Puedes crear gastos individualmente o en masa. Aquí un ejemplo simple:
        
        Gasto::create([
            'nombre' => 'Internet',
            'monto' => 600,
            'categoria' => 'servicio',
        ]);
        
        Gasto::create([
            'nombre' => 'Electricidad',
            'monto' => 1200,
            'categoria' => 'servicio',
        ]);
        
        // O usar un bucle para generar varios gastos
        for ($i = 1; $i <= 10; $i++) {
            Gasto::create([
                'nombre' => 'Gasto ' . $i,
                'monto' => rand(100, 1000), // Montos aleatorios entre 100 y 1000
                'categoria' => 'servicio',
            ]);
        }
    }

}

