<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CompraPromocion extends Model
{
    protected $dates = ['fecha_expiracion'];

    protected $table = 'compras_promociones'; // Especifica el nombre correcto de la tabla

    protected $fillable = ['cliente_id', 'promocion_id', 'fecha_compra', 'fecha_expiracion', 'value'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function promocion()
    {
        return $this->belongsTo(Promocion::class);
    }
}