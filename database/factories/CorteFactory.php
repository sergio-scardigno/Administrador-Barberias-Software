<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;
use App\Models\Corte;

use App\Models\Cliente;
use App\Models\Tipo;
use App\Models\Barber;


class CorteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Corte::class;

    public function definition()
    {
        return [
            'clientes_id' => Cliente::inRandomOrder()->first()->id, // Suponiendo que tienes al menos 10 clientes
            'tipos_id' => Tipo::inRandomOrder()->first()->id, // Suponiendo que tienes algunos tipos definidos
            'fecha' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            'descripcion' => $this->faker->sentence,
            'barbers_id' => Barber::inRandomOrder()->first()->id, // Suponiendo que tienes algunos barberos
            'monto' => $this->faker->randomNumber(3),
            'medio_de_pago' => $this->faker->numberBetween(1, 3), // Suponiendo que tienes definidos algunos medios de pago
        ];
    }
}
