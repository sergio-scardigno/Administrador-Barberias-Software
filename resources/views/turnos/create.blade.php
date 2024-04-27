<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Página de Turnos
        </h2>
    </x-slot>

    <div class="container">
        <h1>{{ isset($turno) ? 'Editar Turno' : 'Crear Turno' }}</h1>
        <form action="{{ isset($turno) ? route('turnos.update', $turno) : route('turnos.store') }}" method="POST">
            @csrf
            @if(isset($turno))
                @method('PUT')
            @endif
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" id="cliente_id" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ (isset($turno) && $turno->cliente_id == $cliente->id) ? 'selected' : '' }}>
                        {{ $cliente->nombre }} {{ $cliente->apellido }}
                    </option>
                @endforeach
            </select>


            <label for="servicio_id">Servicio ID:</label>

            <select name="servicio_id" id="servicio_id" required>
                <option value="">Seleccione un tipo de servicio</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ (isset($turno) && $turno->tipo == $tipo->id) ? 'selected' : '' }}>
                        {{ $tipo->nombres }}
                    </option>
                @endforeach
            </select>    
            
            <label for="fecha_hora_inicio">Fecha y Hora de Inicio:</label>
            <input type="datetime-local" name="fecha_hora_inicio" value="{{ $turno->fecha_hora_inicio ?? '' }}" required>
            
            <!-- <label for="fecha_hora_fin">Fecha y Hora de Fin:</label>
            <input type="datetime-local" name="fecha_hora_fin" value="{{ $turno->fecha_hora_fin ?? '' }}" required>
             -->
            <button type="submit">{{ isset($turno) ? 'Actualizar' : 'Crear' }}</button>
        </form>
    </div>
</x-app-layout>
