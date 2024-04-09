<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Corte extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'clientes_id',
        'tipos_id',
        'barbers_id',
        'fecha',
        'descripcion',
        'monto',
        'medio_de_pago',
    ];


    public function Barber()
    {
//        Trae los datos de la tabla de Barber por eso es belongsto

        return $this->belongsTo(Barber::class);

    }

    public function Tipo()
    {
//        Trae los datos de la tabla de Tipo por eso es belongsto

        return $this->belongsTo(Tipo::class);
    }

    public function Cliente()
    {
//        Trae los datos de la tabla de cliente por eso es belongsto

        return $this->belongsTo(Cliente::class);
    }
}
