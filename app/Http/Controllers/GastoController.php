<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gastos = Gasto::latest()->take(10)->get();
        
        return view('gastos.index', compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gastos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Aquí validas los campos necesarios, por ejemplo:
            'nombre' => 'required|max:255',
            'monto' => 'required|numeric',
            'categoria' => 'required|max:255',
            // Añade todas las validaciones necesarias para tu caso
        ]);

        // dd($validatedData);

        $gasto = Gasto::create($validatedData);

        return redirect()->route('gastos.index')->with('success', 'Gasto creado exitosamente.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('gastos.show', compact('gasto'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $gastos = Gasto::latest()->take(10)->get();
        // Busca el gasto por su ID. Si no existe, fallará y mostrará un error 404.
        $gasto = Gasto::findOrFail($id);

        // Pasamos el gasto a la vista para que se puedan editar sus detalles.
        // Asegúrate de tener una vista 'gastos.edit' que reciba este gasto y muestre el formulario de edición.
        return view('gastos.edit', compact('gasto', 'gastos'));
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos recibidos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'monto' => 'required|numeric',
            'categoria' => 'required|max:255',
            // Agrega aquí todas las validaciones necesarias para tu caso
        ]);
    
        // Buscar el gasto por su ID. Si no existe, fallará y mostrará un error 404.
        $gasto = Gasto::findOrFail($id);
    
        // Actualizar el gasto con los datos validados
        $gasto->update($validatedData);
    
        // Redirigir a alguna ruta después de actualizar, por ejemplo, al listado de gastos.
        // Asegúrate de tener una ruta definida que quieras usar aquí, por ejemplo, 'gastos.index'.
        return redirect()->route('gastos.index')->with('success', 'Gasto actualizado exitosamente.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gasto = Gasto::findOrFail($id); // Asegúrate de que el gasto exista.

        $gasto->delete(); // Realiza el soft delete.
    
        // Redirige a donde prefieras después de eliminar el gasto. Por ejemplo, de vuelta al listado de gastos.
        return redirect()->route('gastos.index')->with('success', 'Gasto eliminado exitosamente.');
    
   
    }
}
