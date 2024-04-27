<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Promocion;
use App\Models\CompraPromocion;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $promociones = Promocion::all();

        $hoy = date('Y-m-d');
        $promocionesVigentes = CompraPromocion::with('cliente') // Pre-cargar los datos del cliente
                                   ->where('fecha_expiracion', '>=', $hoy)
                                   ->where('value', '>', 0)
                                   ->get();
    
        //dd($promocionesVigentes->toArray());
        
        return view('promociones.index', compact('promociones', 'clientes', 'promocionesVigentes'));
    }

    public function create()
    {
        return view('promociones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cantidad_cortes' => 'required|integer|min:0|max:30',
            'descuento' => 'required|numeric|min:0' 
        ]);

        $promocion = new Promocion([
            'cantidad_cortes' => $request->cantidad_cortes,
            'descuento' => $request->descuento,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $promocion->save();

        return redirect()->route('promociones.index')->with('success', 'Promoción creada con éxito');
    }

    public function edit(int $id)
    {
        $promocion = Promocion::findOrFail($id);
        return view('promociones.edit', compact('promocion'));
    }
    

    public function update(Request $request, int $id)
    {
        $request->validate([
            'cantidad_cortes' => 'required|integer|min:3|max:4',
            'descuento' => 'required|numeric',
        ]);
    
        $promocion = Promocion::findOrFail($id); // Buscar la promoción basada en el ID proporcionado
    
        $promocion->update($request->all());
    
        return redirect()->route('promociones.index')->with('success', 'Promoción actualizada con éxito');
    }
    

    public function destroy($id)
    {
        $promocion = Promocion::findOrFail($id); 
        $promocion->delete();

        return redirect()->route('promociones.index')->with('success', 'Promoción eliminada con éxito');
    }

    
}
