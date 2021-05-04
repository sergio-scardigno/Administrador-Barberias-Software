<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Barber;
use App\Models\Corte;
use App\Models\Gasto;
use App\Models\Tipo;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class CorteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * //     * @return \Illuminate\Http\Response
     * //     */

//php artisan make:seeder TipoSeeder

    public function index()
    {
        $clientes = Corte::join('clientes', 'clientes_id', '=', 'clientes.id')
            ->join('barbers', 'barbers_id', '=', 'barbers.id')
            ->join('tipos', 'tipos_id', '=', 'tipos.id')
            ->select('cortes.*', 'barbers.nombre as nombre_barbers', 'tipos.nombres as tipo_nombre', 'clientes.nombre as cliente_nombre', 'apellido')
            ->get();

        $cliente_totales = Cliente::all();
        $barbers = Barber::all();
        $cortes = Corte::all();
        $tipos = Tipo::all();
//        $gastos = Gasto::all();

//dd($clientes);

        return view('/dashboard')->with('barbers', $barbers)->with('clientes', $clientes)->with('tipos', $tipos)->with('cortes', $cortes)->with('cliente_totales', $cliente_totales);

    }

    /**
     * Show the form for creating a new resource.
     *
     * //     * @return \Illuminate\Http\Response
     * //     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * //     * @param \Illuminate\Http\Request $request
     * //     * @return \Illuminate\Http\Response
     * //     */
    public function store(Request $request)
    {
//        $this->validate($request, [
//
////            'name' => 'bail|required|max:50',
////            'description' => 'required|max:200',
////            'status_id' => 'required|max:200',
//
//        ]);
//
        $corte = new Corte ([
            'clientes_id' => $request->cliente_id,
            'tipos_id' => $request->tipos_id,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'barbers_id' => $request->barbers_id,
            'monto' => $request->monto,
        ]);
//        dd($request);

        $corte->save();

        return redirect('/dashboard')->with('success', 'Task has been added');
    }

    /**
     * Display the specified resource.
     *
     * //     * @param int $id
     * //     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * //     * @param int $id
     * //     * @return \Illuminate\Http\Response
     * //     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * //     * @param \Illuminate\Http\Request $request
     * //     * @param int $id
     * //     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * //     * @param int $id
     * //     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }
}
