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
use App\Models\MediosDePagos;

use Carbon\Carbon;


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

//        Funcion que muesta la tabla de dashboard con nombres de Barber y clientes

//        Empieza acá

        $clientes = Corte::join('clientes', 'clientes_id', '=', 'clientes.id')
            ->join('barbers', 'barbers_id', '=', 'barbers.id')
            ->join('tipos', 'tipos_id', '=', 'tipos.id')
            ->select('cortes.*', 'barbers.nombre as nombre_barbers', 'tipos.nombres as tipo_nombre', 'clientes.nombre as cliente_nombre', 'apellido')
            ->orderBy('fecha', 'desc')
            ->paginate(6);            ;

//        Termina acá


//        dd($clientes);

        $cliente_totales = Cliente::orderBy('nombre')->get();
        $barbers = Barber::all();
        $cortes = Corte::all();
        $tipos = Tipo::all();
        $pagos = MediosDePagos::all();
        
        // dd($pagos);


        $gastos = Gasto::all();

//        dd($tipos);

        return view('/dashboard')->with('barbers', $barbers)->with('clientes', $clientes)->with('tipos', $tipos)->with('cortes', $cortes)->with('cliente_totales', $cliente_totales)->with('pagos', $pagos);

//        return view('/dashboard');

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
        $this->validate($request, [

            'cliente_id' => 'bail|required|max:50',
            'tipos_id' => 'required|max:200',
            'descripcion' => 'required|max:200',
            'barbers_id' => 'required|',
            'monto' => 'required|max:200',
            'medio_de_pago' => 'required|max:10',

        ]);
//
        $corte = new Corte ([
            'clientes_id' => $request->cliente_id,
            'tipos_id' => $request->tipos_id,
            'fecha' => Carbon::now()->toDateTimeString(), // Formato 'YYYY-MM-DD HH:MM:SS',
            'descripcion' => $request->descripcion,
            'barbers_id' => $request->barbers_id,
            'monto' => $request->monto,
            'medio_de_pago' => $request->medio_de_pago,
            
        ]);
        
        
        // dd($corte);

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


        $cortes = Corte::find($id);

        $clientes = Corte::join('clientes', 'clientes_id', '=', 'clientes.id')
            ->join('barbers', 'barbers_id', '=', 'barbers.id')
            ->join('tipos', 'tipos_id', '=', 'tipos.id')
            ->select('cortes.*', 'barbers.nombre as nombre_barbers', 'tipos.nombres as tipo_nombre', 'clientes.nombre as cliente_nombre', 'apellido')
            ->get();
        $cliente_totales = Cliente::all();
        $barbers = Barber::all();
//        $cortes = Corte::all();
        $tipos = Tipo::all();


        return view ('/corte.edit')->with('barbers', $barbers)->with('clientes', $clientes)->with('tipos', $tipos)->with('cortes', $cortes)->with('cliente_totales', $cliente_totales);
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


        $cortes = Corte::find($id);

        $this->validate($request, [

            'barbers_id' => 'bail|required|max:50',
            'cliente_id' => 'required|max:200',
            'tipos_id' => 'required',
            'fecha' => 'required|max:200|date',
            'monto' => 'required|',
            'descripcion' => 'required|max:200',

        ]);

        $cortes->update([
            'barbers_id' => $request->barbers_id,
            'cliente_id' => $request->cliente_id,
            'tipos_id' => $request->tipos_id,
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
        ]);

        return redirect('/dashboard')->with('success', 'Task has been added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * //     * @param int $id
     * //     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $corte = Corte::where('id',$id)->first();;
        $corte->delete();
        return back()->with('info', 'Fue eliminado exitosamente');
    }

    public function delete()
    {


        $cortes_borrados = Corte::onlyTrashed()
            ->join('clientes', 'clientes_id', '=', 'clientes.id')
            ->join('barbers', 'barbers_id', '=', 'barbers.id')
            ->join('tipos', 'tipos_id', '=', 'tipos.id')
            ->select('cortes.*', 'barbers.nombre as nombre_barbers', 'tipos.nombres as tipo_nombre', 'clientes.nombre as cliente_nombre', 'apellido')
            ->get();

//        dd($cortes_borrados);

        return view('/corte.delete')->with('cortes_borrados', $cortes_borrados);

    }

    public function restore( $id )
    {
        //Indicamos que la busqueda se haga en los registros eliminados con withTrashed

        $corte = Corte::withTrashed()->where('id', '=', $id)->first();

        //Restauramos el registro
        $corte->restore();

        return redirect('/dashboard')->with('success', 'Task has been added');
    }

}


