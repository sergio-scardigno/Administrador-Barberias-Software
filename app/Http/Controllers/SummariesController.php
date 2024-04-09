<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Cliente;
use App\Models\Barber;
use App\Models\Corte;
use App\Models\Gasto;
use App\Models\Tipo;
use App\Models\User;

use Carbon\Carbon;



class SummariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obteniendo el año y el mes desde el request, usando el año y mes actual como predeterminado
        $anioSeleccionado = $request->input('anio', Carbon::now()->year);
        $mesSeleccionado = $request->input('mes', Carbon::now()->month);

        // Creando un objeto Carbon con el año y el mes seleccionados
        $fechaSeleccionada = Carbon::createFromDate($anioSeleccionado, $mesSeleccionado, 1);

        // Utiliza $fechaSeleccionada para filtrar tus consultas por el mes y el año seleccionados
        $total_corte_month = Corte::whereYear('fecha', '=', $fechaSeleccionada->year)
            ->whereMonth('fecha', '=', $fechaSeleccionada->month)
            ->whereIn('barbers_id', [1])
            ->join('barbers', 'barbers_id', '=', 'barbers.id')
            ->get();

        $gastosMes = Gasto::whereYear('created_at', '=', $fechaSeleccionada->year)
            ->whereMonth('created_at', '=', $fechaSeleccionada->month)
            ->get();

        // Devuelve la vista con los datos filtrados por el año y el mes seleccionados
        return view('/summaries.index', compact('total_corte_month', 'gastosMes'));
 
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
