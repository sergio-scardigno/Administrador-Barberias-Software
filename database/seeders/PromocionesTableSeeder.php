<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocionesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('promociones')->insert([
            [
                'cantidad_cortes' => 3,
                'descuento' => 10.00, // 10% de descuento
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'cantidad_cortes' => 4,
                'descuento' => 15.00, // 15% de descuento
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}


