<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class Cortador extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cortadores')->insert([
            'nombre y apellido' => 'Peluquero 1',
            'created_at' => Carbon::create('2000', '01', '01')
        ]);


    }
}

