<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\Cliente;
use App\Models\Tipo;


use Illuminate\Http\Request;

class TurnoController extends Controller
{
    // Mostrar lista de turnos
    public function index()
    {
        $clientes = Cliente::all();
        $turnos = Turno::with('cliente')
        ->orderBy('fecha_hora_inicio', 'desc')
        ->limit(5)
        ->get();
            
        // var_dump($turnos);

        return view('turnos.index', compact('turnos', 'clientes'));
    }

    // Mostrar formulario para crear un nuevo turno
    public function create()
    {
        $clientes = Cliente::all();
        $tipos = Tipo::all();

        // dd($tipos);

        return view('turnos.create', compact('clientes', 'tipos'));
    }

    // Guardar un nuevo turno
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'servicio_id' => 'required',
            'fecha_hora_inicio' => 'required|date',
        ]);
    
        $turno = new Turno();
        $turno->cliente_id = $request->cliente_id;
        $turno->servicio_id = $request->servicio_id;
        $turno->fecha_hora_inicio = $request->fecha_hora_inicio;

        // var_dump($request->servicio_id);

        $servicio_id = (int)$request->servicio_id;

        echo $servicio_id;

    
        // Define la duración del turno según el tipo de servicio seleccionado
        $duracion = 0;
        switch ($request->servicio_id) {
            case 1: // ID del servicio de pelo
                $duracion = 40; // Duración de 40 minutos para servicio de pelo
                break;
            case 2: // ID del servicio de barba
                $duracion = 20; // Duración de 20 minutos para servicio de barba
                break;
            case 3: // ID del servicio de pelo y barba
                $duracion = 70; // Duración de 70 minutos para servicio de pelo y barba
                break;
            default:
                $duracion = 40; // Por defecto, duración de 40 minutos
                break;
        }
        

        // echo($duracion);
    
        // Calcula la hora de finalización sumando la duración al inicio
        $fecha_hora_inicio = new \DateTime($request->fecha_hora_inicio);
        $fecha_hora_fin = $fecha_hora_inicio->add(new \DateInterval('PT'.$duracion.'M'));
        $turno->fecha_hora_fin = $fecha_hora_fin->format('Y-m-d H:i:s');
    
        $turno->save();
    
        return redirect()->route('turnos.index')->with('success', 'Turno creado exitosamente.');
    }
    

    // Mostrar formulario para editar un turno existente
    public function edit(Turno $turno)
    {
        $clientes = Cliente::all(); // Asume que tienes un modelo Cliente
        $tipos = Tipo::all(); // Asume que tienes un modelo TipoServicio o el nombre correcto del modelo que maneja los servicios
    
        return view('turnos.edit', compact('turno', 'clientes', 'tipos'));
    }

    // Actualizar un turno existente
    public function update(Request $request, Turno $turno)
    {
        $request->validate([
            'cliente_id' => 'required',
            'servicio_id' => 'required',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio'
        ]);

        $turno->update($request->all());
        return redirect()->route('turnos.index')->with('success', 'Turno actualizado exitosamente.');
    }

    // Borrar un turno
    public function destroy(Turno $turno)
    {
        // dd($turno); // Esto mostrará los detalles del turno y detendrá la ejecución
        $turno->delete();
        return redirect()->route('turnos.index')->with('success', 'Turno eliminado exitosamente.');
    }

    public function calendarioTurnos()
    {
        $turnos = Turno::with('cliente')->get();  // Asegúrate de cargar la relación con 'cliente'
        
        $eventos = $turnos->map(function ($turno) {
            // Combina nombre y apellido para el título
            $titulo = $turno->cliente->nombre . ' ' . $turno->cliente->apellido;
            return [
                'id'    => $turno->id,
                'title' => $titulo,  // Usa el nombre y apellido del cliente como título
                'start' => $turno->fecha_hora_inicio->format('Y-m-d\TH:i:s'), // Corregir formato de fecha y hora
                'end'   => $turno->fecha_hora_fin->format('Y-m-d\TH:i:s'),    // Corregir formato de fecha y hora
                'email' => $turno->cliente->correo,  // Añadiendo el correo
                'phone' => $turno->cliente->telefono  // Añadiendo el teléfono
            ];
        });
    
        return response()->json($eventos);
    }
    

    public function turnosDeHoy()
    {
        $hoy = now()->startOfDay(); // Comienza al inicio del día
        $manana = now()->endOfDay(); // Termina al final del día
    
        $turnos = Turno::with('cliente')
                    ->where('fecha_hora_inicio', '>=', $hoy)
                    ->where('fecha_hora_inicio', '<=', $manana)
                    ->get();
    
        $eventos = $turnos->map(function ($turno) {
            return [
                'id'    => $turno->id,
                'title' => $turno->cliente->nombre . ' ' . $turno->cliente->apellido,
                'start' => $turno->fecha_hora_inicio->format('H:i'), // Formato de 24 horas
                'end'   => $turno->fecha_hora_fin->format('H:i'),
            ];
        });
    
        return response()->json($eventos);
    }
    
    
    
    
    
}
