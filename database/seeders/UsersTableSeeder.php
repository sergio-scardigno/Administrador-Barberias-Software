<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Inserta un usuario predeterminado
        User::create([
            'name' => 'Sergio',
            'email' => 'sergioscardigno82@gmail.com',
            'password' => Hash::make('Argentina1982'),
        ]);
    }
}