<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Página de Turnos - Editar
        </h2>
    </x-slot>

    <div class="container">
        <h1>Editar Turno</h1>
        <form action="{{ route('turnos.update', $turno->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Método PUT para actualizar recursos --}}

            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" id="cliente_id" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" 
                        {{ $turno->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }} {{ $cliente->apellido }}
                    </option>
                @endforeach
            </select>

            <select name="servicio_id" id="servicio_id" required>
                <option value="">Seleccione un tipo de servicio</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ (isset($turno) && $turno->tipo == $tipo->id) ? 'selected' : '' }}>
                        {{ $tipo->nombres }}
                    </option>
                @endforeach
            </select>   


            <label for="fecha_hora_inicio">Fecha y Hora de Inicio:</label>
            <input type="datetime-local" name="fecha_hora_inicio" 
                   value="{{ $turno->fecha_hora_inicio->format('Y-m-d\TH:i') }}" required>
            
            <label for="fecha_hora_fin">Fecha y Hora de Fin:</label>
            <input type="datetime-local" name="fecha_hora_fin" 
                   value="{{ $turno->fecha_hora_fin->format('Y-m-d\TH:i') }}" required>
            
            <button type="submit">Actualizar Turno</button>
        </form>
    </div>
</x-app-layout>
