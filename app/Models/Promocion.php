<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Promocion extends Model
{
    use SoftDeletes;

    protected $table = 'promociones'; // Especifica el nombre correcto de la tabla



    protected $fillable = ['cantidad_cortes', 'descuento'];

    protected $dates = ['deleted_at', 'fecha_expiracion']; // Esto es opcional si deseas personalizar el nombre del campo de eliminación suave



    public function Cliente()
    {
//        Trae los datos de la tabla de cliente por eso es belongsto

        return $this->belongsTo(Cliente::class);
    }

}

