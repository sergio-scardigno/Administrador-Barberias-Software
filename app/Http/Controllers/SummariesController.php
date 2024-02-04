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
    public function index()
    {

        $total_corte_day = Corte::whereDate('fecha', '=', Carbon::now()->format('Y-m-d'))
            ->whereIn('barbers_id', [1])
            ->join('barbers', 'barbers_id', '=', 'barbers.id')
            ->get();

        $total_corte_day_suma = Corte::whereDate('fecha', '=', Carbon::now()->format('Y-m-d'))
            ->whereIn('barbers_id', [1])
            ->sum('monto');

        $barberia_monto = $total_corte_day_suma/2;

        $barbero_monto = $total_corte_day_suma/2;

//        Barbero 2

        $total_corte_day_two = Corte::whereDate('fecha', '=', Carbon::now()->format('Y-m-d'))
            ->whereIn('barbers_id', [2])
            ->join('barbers', 'barbers_id', '=', 'barbers.id')
            ->get();

        $total_corte_day_suma_two = Corte::whereDate('fecha', '=', Carbon::now()->format('Y-m-d'))
            ->whereIn('barbers_id', [2])
            ->sum('monto');

        $barberia_monto_two = $total_corte_day_suma_two/2;

        $barbero_monto_two = $total_corte_day_suma_two/2;

        $total_barberia = $barberia_monto_two + $barberia_monto;


//        dd($barbero_monto_two);

        return view ('/summaries.index')
            ->with('cortes', $total_corte_day)
            ->with('suma', $total_corte_day_suma)
            ->with('barberia', $barberia_monto)
            ->with('barbero', $barbero_monto)

            ->with('cortes_twos', $total_corte_day_two)
            ->with('sumas_two', $total_corte_day_suma_two)
            ->with('barberia_two', $barberia_monto_two)
            ->with('barbero_two', $barbero_monto_two)

            ->with('total_barberia', $total_barberia)





            ;
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
