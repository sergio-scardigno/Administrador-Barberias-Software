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


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $clientes = Cliente::all();

        return view('/cliente/create')->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'nombre' => 'bail|required|max:50',
            'apellido' => 'required|max:200',
            'correo' => 'email|max:200',
            'telefono' => 'required|max:15',

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
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cortes = Corte::where('clientes_id','like','%'.$id.'%')->get();

        $cliente = Cliente::find($id);

//        dd($cortes);

        return view ('/cliente.edit')->with('cliente', $cliente)->with('cortes', $cortes);
    }

    /**
     * Update the specified resource in storage.
     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
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
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::where('id',$id)->first();;
        $cliente->delete();
        return back()->with('info', 'Fue eliminado exitosamente');
    }
}
