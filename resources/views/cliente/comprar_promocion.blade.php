<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pagina de Turnos
        </h2>
    </x-slot>

    <div class="container">

    <h1>Comprar Promoción para {{ $cliente->nombre }}</h1>

    <form method="POST" action="{{ route('cliente.comprar', $cliente->id) }}">
        @csrf

        <div class="form-group">
            <label for="promocion_id">Seleccionar Promoción:</label>
            <select name="promocion_id" id="promocion_id" class="form-control">
                @foreach($promociones as $promocion)
                    <option value="{{ $promocion->id }}">{{ $promocion->nombre }} - {{ $promocion->descuento }}% de descuento</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Comprar Promoción</button>
    </form>

    </div>





</x-app-layout>