<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Barber;
use App\Models\Corte;
use App\Models\Gasto;
use App\Models\Tipo;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use App\Models\CompraPromocion;
use App\Models\Promocion;
use Illuminate\Support\Carbon;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $clientes = Cliente::all();

        return view('/cliente/create')->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'nombre' => 'bail|required|max:50',
            'apellido' => 'required|max:200',
            'correo' => 'email|max:200|nullable|present',
            'telefono' => 'max:15|nullable|present',

        ]);

        $cliente = new Cliente ([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'telefono' => $request->telefono,

        ]);
//        dd($request);

        $cliente->save();

        return redirect('/cliente')->with('success', 'Task has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cortes = Corte::where('clientes_id','like','%'.$id.'%')->get();

        $cliente = Cliente::find($id);

        $hoy = date('Y-m-d'); // Obtener la fecha de hoy

        // Obtener las promociones vigentes que no han expirado
        $promocionesVigentes = CompraPromocion::where('cliente_id', $id)
                                            ->where('fecha_expiracion', '>=', $hoy)
                                            ->get();

        // dd($promocionesVigentes);

        return view ('/cliente.edit')->with('cliente', $cliente)->with('cortes', $cortes)->with('promocionesVigentes', $promocionesVigentes);
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
        $cliente = Cliente::find($id);

        $this->validate($request, [

            'nombre' => 'bail|required|max:50',
            'apellido' => 'required|max:200',
            'correo' => 'email|max:200',
            'telefono' => 'required|max:15',

        ]);

        $cliente->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
        ]);

        return redirect('/cliente')->with('success', 'Task has been added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::where('id',$id)->first();;
        $cliente->delete();
        return back()->with('info', 'Fue eliminado exitosamente');
    }

    public function mostrarFormularioCompra($clienteId)
    {
        $cliente = Cliente::findOrFail($clienteId);
        $promociones = Promocion::all(); // Obtener todas las promociones disponibles
        return view('cliente.comprar_promocion', compact('cliente', 'promociones'));
    }

    public function comprarPromocion(Request $request, $clienteId)
    {
        $this->validate($request, [
            'promocion_id' => 'required|exists:promociones,id',
        ]);

        $cliente = Cliente::findOrFail($clienteId);
        $promocion = Promocion::findOrFail($request->promocion_id);
        $fechaCompra = Carbon::now();
        $fechaExpiracion = $fechaCompra->copy()->addDays(30);

        $compraPromocion = CompraPromocion::create([
            'cliente_id' => $cliente->id,
            'promocion_id' => $promocion->id,
            'fecha_compra' => $fechaCompra,
            'fecha_expiracion' => $fechaExpiracion
        ]);

        return redirect('/cliente')->with('success', 'Paquete comprado exitosamente, expira el ' . $fechaExpiracion->toDateString());
    }
}