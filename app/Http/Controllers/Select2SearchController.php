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

class Select2SearchController extends Controller
{
    public function index()
    {
        return view('select2.index');
    }
    /**
     * Show the application dataAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataAjax(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Cliente::select("id","nombre","apellido")
                ->where('nombre','LIKE',"%$search%")
                ->get();
        }
        return response()->json($data);
    }
}
