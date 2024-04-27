<?php

namespace App\Http\Controllers;

use App\Models\CompraPromocion;
use App\Models\Cliente;
use App\Models\Corte;
use Illuminate\Http\Request;

class CompraPromocionController extends Controller
{
        // Mostrar lista de turnos
        public function promociones($id)
        {
            $cliente = Cliente::find($id);
            $hoy = date('Y-m-d');
        
            $promocionesVigentes = CompraPromocion::where('cliente_id', $id)
                                                  ->where('fecha_expiracion', '>=', $hoy)
                                                  ->where('value', '>', 0)  // Asegura que el value sea mayor a 0
                                                  ->get();
        
            $tienePromocion = $promocionesVigentes->isNotEmpty();  // Verifica si hay promociones
        
            return response()->json([
                'tiene_promocion' => $tienePromocion,
                'promociones' => $promocionesVigentes
            ]);
        }

        public function actualizarPromocion(Request $request, $cliente_id)
        {
            $cliente = Cliente::find($cliente_id);

            if (!$cliente) {
                return response()->json(['message' => 'Cliente no encontrado'], 404);
            }

            // Suponiendo que sólo deseas decrementar el valor
            $promocion = CompraPromocion::where('cliente_id', $cliente_id)
                                        ->where('fecha_expiracion', '>=', now())
                                        ->orderBy('fecha_compra', 'desc')
                                        ->first();

            if ($promocion && $promocion->value > 0) {
                $promocion->value -= 1;  // Decrementa el valor
                $promocion->save();
                return response()->json(['message' => 'Promoción actualizada con éxito']);
            }

            return response()->json(['message' => 'No se encontró una promoción válida o ya no es posible aplicarla']);
        }

        
        
    
}
