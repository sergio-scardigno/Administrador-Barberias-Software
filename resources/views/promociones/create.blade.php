<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pagina de create
        </h2>
    </x-slot>

    <div class="container">
    <h1>Crear Promoción</h1>
    <form method="POST" action="{{ route('promociones.store') }}">
        @csrf
        <div class="form-group">
            <label for="cantidad_cortes">Cantidad de Cortes</label>
            <input type="number" class="form-control" id="cantidad_cortes" name="cantidad_cortes" required min="1" max="30">
        </div>
        <div class="form-group">
            <label for="descuento">Descuento (%)</label>
            <input type="number" class="form-control" id="descuento" name="descuento" required step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>





</x-app-layout>