<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pagina de editar
        </h2>
    </x-slot>

    <div class="container">
    <h1>Editar Promoción</h1>
    <form method="POST" action="{{ route('promociones.update', $promocion->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cantidad_cortes">Cantidad de Cortes</label>
            <input type="number" class="form-control" id="cantidad_cortes" name="cantidad_cortes" value="{{ $promocion->cantidad_cortes }}" required min="3" max="4">
        </div>
        <div class="form-group">
            <label for="descuento">Descuento (%)</label>
            <input type="number" class="form-control" id="descuento" name="descuento" value="{{ $promocion->descuento }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>





</x-app-layout>