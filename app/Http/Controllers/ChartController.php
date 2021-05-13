<?php

namespace App\Http\Controllers;

use App\Charts\chart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Corte;
use Illuminate\Support\Facades\DB;
use App\Models\User;
//use ConsoleTVs\Charts\Charts;

use ConsoleTVs\Charts\BaseChart;
use Chartisan\PHP\Chartisan;

class ChartController extends Controller
{
    public function index()
    {
//        $hoy = Carbon::now()->startofMonth()->subMonth()->endOfMonth()->toDateString();

//        $monto = Corte::where('fecha', '>=', Carbon::today()->startOfMonth()->subMonth())->toArray('monto', 'fecha');
//
////        $actual = $hoy->format('Y m d');
////
////        $monto = Corte::query()
////            ->select('monto')
////            ->pluck('monto')
////            ->all();
//
//
////        $fechas = collect($fecha)->pluck('fecha')->toArray();
////        $montos = collect($monto)->pluck('monto')->toArray();
//
//
//        dd($monto);

        return view('chart.chart');
    }
}
