<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; // Importa el trait SoftDeletes


class Turno extends Model
{
    use HasFactory;
    use SoftDeletes; // Usa el trait SoftDeletes


    protected $fillable = ['cliente_id', 'servicio_id', 'fecha_hora_inicio', 'fecha_hora_fin'];

    // Añade las columnas de fecha a la propiedad $dates para que sean tratadas como instancias de Carbon
    protected $dates = ['fecha_hora_inicio', 'fecha_hora_fin'];

    // Relación con el modelo Cliente
    public function Cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con el modelo Tipo
    public function Tipo()
    {
        return $this->belongsTo(Tipo::class);
    }


}

