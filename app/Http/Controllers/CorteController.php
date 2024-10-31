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
use App\Models\CompraPromocion;


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

        //Funcion que muesta la tabla de dashboard con nombres de Barber y clientes


        // $clientes = Corte::join('clientes', 'clientes_id', '=', 'clientes.id')
        //     ->join('barbers', 'barbers_id', '=', 'barbers.id')
        //     ->join('tipos', 'tipos_id', '=', 'tipos.id')
        //     ->select('cortes.*', 'barbers.nombre as nombre_barbers', 'tipos.nombres as tipo_nombre', 'clientes.nombre as cliente_nombre', 'apellido')
        //     ->orderBy('fecha', 'desc')
        //     ->paginate(10); 
        
        // Funcion trae todos los cortes del dia
        
        $clientes = Corte::join('clientes', 'cortes.clientes_id', '=', 'clientes.id')
            ->join('barbers', 'cortes.barbers_id', '=', 'barbers.id')
            ->join('tipos', 'cortes.tipos_id', '=', 'tipos.id')
            ->select('cortes.*', 'barbers.nombre as nombre_barbers', 'tipos.nombres as tipo_nombre', 'clientes.nombre as cliente_nombre', 'clientes.apellido')
            ->whereDate('cortes.fecha', Carbon::today())
            ->orderBy('cortes.fecha', 'desc')
            ->get();    



        //dd($clientes);

        $cliente_totales = Cliente::orderBy('nombre')->get();
        $barbers = Barber::all();
        $cortes = Corte::all();
        $tipos = Tipo::all();
        $pagos = MediosDePagos::all();
        
        // dd($pagos);


        $gastos = Gasto::all();

        //dd($tipos);

        return view('/dashboard')->with('barbers', $barbers)->with('clientes', $clientes)->with('tipos', $tipos)->with('cortes', $cortes)->with('cliente_totales', $cliente_totales)->with('pagos', $pagos);


    }

    public function list ()
    {

        $listadoCortes = Corte::join('clientes', 'cortes.clientes_id', '=', 'clientes.id')
        ->join('barbers', 'cortes.barbers_id', '=', 'barbers.id')
        ->join('tipos', 'cortes.tipos_id', '=', 'tipos.id')
        ->select('cortes.*', 'barbers.nombre as nombre_barbers', 'tipos.nombres as tipo_nombre', 'clientes.nombre as cliente_nombre', 'clientes.apellido')
        ->orderBy('cortes.fecha', 'desc')
        ->get();  

        
        return view ('/corte.index')->with('listadoCortes', $listadoCortes);
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
             'barbers_id' => 'required',
             'monto' => 'required|max:200',
             'medio_de_pago' => 'required|max:10',
             'promocion_id' => 'nullable|exists:promociones,id'  // Asegura que el ID de la promoción exista si se proporciona
         ]);
     
         // Creación del corte con los datos recibidos
         $corte = new Corte([
             'clientes_id' => $request->cliente_id,
             'tipos_id' => $request->tipos_id,
             'fecha' => Carbon::now()->toDateTimeString(), // Formato 'YYYY-MM-DD HH:MM:SS',
             'descripcion' => $request->descripcion,
             'barbers_id' => $request->barbers_id,
             'monto' => $request->monto,
             'medio_de_pago' => $request->medio_de_pago,
             'promocion_id' => $request->promocion_id ?? null  // Asigna el ID de la promoción si está presente
         ]);
     
         // Guarda el corte en la base de datos
         $corte->save();
     
         // Redirecciona al dashboard con un mensaje de éxito
         return redirect('/dashboard')->with('success', 'Corte registrado con éxito.');
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


    public function compraPromocion(Request $request)
    {
        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'promocion_id' => 'nullable',
            'monto' => 'required|numeric'
        ]);

        // Obtenemos todos los datos del request
        $allData = $request->all();

        // Usamos explode para separar el valor de promocion_id en partes
        if (isset($allData['promocion_id'])) {
            $parts = explode('-', $allData['promocion_id']);
            
            // Asignamos los valores a variables específicas
            $promocionNumero = $parts[0];
            $promocionPrecio = $parts[1];
            $promocionTipo = $parts[2];

            // Ahora puedes utilizar estas variables como necesites
        }

        // Debugging para ver los datos
        // dd($promocionNumero, $promocionPrecio, $promocionTipo, $allData);

        // dd($request->all());
    
        // Creación del corte con los datos recibidos
        $comprapromocion = new CompraPromocion([
            'cliente_id' => $request->cliente_id, // Cambiado de 'clientes_id' a 'cliente_id'
            'promocion_id' => $promocionTipo,
            'value' => $promocionNumero,
            'fecha_compra' => Carbon::now()->toDateTimeString(), // Formato 'YYYY-MM-DD HH:MM:SS',
            'fecha_expiracion' => Carbon::now()->addDays(30)->toDateTimeString() // Fecha de expiración 30 días después

        ]);

        $corte = new Corte([
            'clientes_id' => $request->cliente_id,
            'promocion_id' => $promocionTipo, // Asegúrate de asignar esto solo una vez
            'monto' => $request->monto,
            'fecha' => Carbon::now()->toDateTimeString(), // Formato 'YYYY-MM-DD HH:MM:SS'
            'descripcion' => 'Compra de cupón '.$promocionNumero.' cortes',
            'barbers_id' => 1, // Asegúrate de que este campo es correcto y necesario
            'tipos_id' => '4',
            'medio_de_pago' => '1',


            
        ]);
        
        // Quiero grabarlo en cortes
        // dd($corte);
    


        // Guarda el corte en la base de datos
        $comprapromocion->save();
        $corte->save();
    
        // Redirecciona al dashboard con un mensaje de éxito
        return redirect('/dashboard')->with('success', 'Corte registrado con éxito.');
    }





}