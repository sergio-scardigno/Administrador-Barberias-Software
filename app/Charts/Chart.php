<?php

declare(strict_types=1);


namespace App\Charts;

use App\Models\Corte;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Carbon\Carbon;


class Chart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $fecha = Corte::query()
            ->select('fecha')
            ->get();

        $monto = Corte::query()
            ->select('monto')
            ->get();

        $fechas = collect($fecha)->pluck('fecha')->toArray();
        $montos = collect($monto)->pluck('monto')->toArray();

        return Chartisan::build()
            ->labels($fechas)
            ->dataset('Sales', $montos);


//Funciona

//        $fechas = Corte::query()
//            ->select('fecha')
//            ->pluck('fecha');
//
//
//        $monto = Corte::query()
//            ->select('monto')
//            ->pluck('monto');
//
//        return Chartisan::build()
//            ->labels($fechas->pluck('x')->toArray())
//            ->dataset('Example Data', $monto->toArray());


//        return Chartisan::build()
//            ->labels()
//            ->dataset('Monto', $monto_chart->monto);

    }
}
