<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;




class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            'nombres' => 'Pelo',
            'created_at' => Carbon::create('2000', '01', '01')
        ]);

        DB::table('tipos')->insert([
            'nombres' => 'Barba',
            'created_at' => Carbon::create('2000', '01', '01')
        ]);

        DB::table('tipos')->insert([
            'nombres' => 'Pelo y Barba',
            'created_at' => Carbon::create('2000', '01', '01')
        ]);

        
        DB::table('tipos')->insert([
            'nombres' => 'Promocion',
            'created_at' => Carbon::create('2000', '01', '01')
        ]);
    }
}
