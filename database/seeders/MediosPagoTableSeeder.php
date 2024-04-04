<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MediosPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medios_de_pagos')->insert([
            ['pagos' => 'Mercado Pago', 'descripcion' => 'Plataforma de pagos online'],
            ['pagos' => 'Cuenta DNI', 'descripcion' => 'App de Banco Provincia para operaciones bancarias y pagos'],
            ['pagos' => 'Efectivo', 'descripcion' => 'Pago con dinero en físico']
        ]);
    }
}
