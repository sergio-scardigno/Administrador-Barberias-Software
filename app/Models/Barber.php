<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        ];

    public function Corte()
    {
//        Esta es la tabla secundaria que trae los datos de la tabla Task por eso es hasMany
        return $this->hasMany(Corte::class);
    }
}
