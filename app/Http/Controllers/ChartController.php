<?php

namespace App\Http\Controllers;

use App\Charts\Chart;
use Illuminate\Http\Request;
use App\Models\Corte;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use ConsoleTVs\Charts\Charts;

use ConsoleTVs\Charts\BaseChart;
use Chartisan\PHP\Chartisan;

class ChartController extends Controller
{
    public function index()
    {
//        $fechas = Corte::query()
//            ->select('fecha')
//            ->pluck('fecha')
//            ->all();
//
//        $monto = Corte::query()
//            ->select('monto')
//            ->pluck('monto')
//            ->all();


        $fecha = Corte::query()
            ->select('fecha')
            ->get();

        $monto = Corte::query()
            ->select('monto')
            ->get();

        $fechas = collect($fecha)->pluck('fecha')->toArray();
        $montos = collect($monto)->pluck('monto')->toArray();

//        dd($montos);


        return view('chart.chart');
    }
}
