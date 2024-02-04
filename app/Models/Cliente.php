<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'telefono',
    ];

    public function Corte()
    {
//        Esta es la tabla secundaria que trae los datos de la tabla Corte por eso es hasMany

        return $this->hasMany(Corte::class);
    }


}
