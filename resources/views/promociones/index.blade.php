<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pagina de Promociones
        </h2>
    </x-slot>

    <div class="container">
        <h1>Promociones</h1>
        <a href="{{ route('promociones.create') }}" class="btn btn-primary mb-3">Agregar Promoción</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Cantidad de Cortes</th>
                    <th>Descuento (%)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promociones as $promocion)
                    <tr>
                        <td>{{ $promocion->cantidad_cortes }}</td>
                        <td>{{ $promocion->descuento }}</td>
                        <td>
                            <a href="{{ route('promociones.edit', $promocion->id) }}" class="btn btn-info">Editar</a>
                            <form action="{{ route('promociones.destroy', $promocion->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar esta promoción?')">Eliminar</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container">

    <form method="POST" action="{{ route('cortes.compraPromocion') }}">
    @csrf

    <!-- Cliente ID -->
    <div class="form-group">
        <label for="cliente_id">Cliente</label>
        <select name="cliente_id" class="form-control" required>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
            @endforeach
        </select>
    </div>

    <!-- Promoción -->
    <div class="form-group">
        <label for="promocion_id">Promoción</label>
        <select name="promocion_id" class="form-control">
            <option value="">Seleccione una promoción</option>
            @foreach ($promociones as $promocion)
                <option value="{{ $promocion->cantidad_cortes }}-{{ $promocion->descuento }}-{{ $promocion->id }}">
                    Cantidad de Cortes {{ $promocion->cantidad_cortes }}: Descuento {{ $promocion->descuento }}%
                </option>
            @endforeach
        </select>
    </div>




    <!-- Monto -->
    <div class="form-group">
        <label for="monto">Monto</label>
        <input type="number" class="form-control" name="monto" required>
    </div>

    <!-- Botón de Envío -->
    <button type="submit" class="btn btn-primary mt-2 mb-5">Compra Promoción</button>
</form>

</div>

<div class="container">
    <h1>Promociones Vigentes</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Valor de la Promoción</th>
                <th>Fecha de Compra</th>
                <th>Fecha de Expiración</th>
                <th>Acciones</th> <!-- Opcional, por si agregas acciones como editar o eliminar -->
            </tr>
        </thead>
        <tbody>
            @foreach($promocionesVigentes as $promocion)
                <tr>
                    <td>{{ $promocion->cliente->nombre }} {{ $promocion->cliente->apellido }}</td>
                    <td>{{ $promocion->value }}</td>
                    <td>{{ \Carbon\Carbon::parse($promocion->fecha_compra)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($promocion->fecha_expiracion)->format('Y-m-d') }}</td>
                    <td>
                        <!-- Botones de acción (editar, eliminar, etc.) -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


</div>





</x-app-layout>