<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pagina de Resumenes
        </h2>
    </x-slot>

    <div class="container mt-3">
        <h1>Cortes del Mes</h1>

        <form action="{{ route('resumen') }}" method="GET">
            <div class="form-group mt-3">
                <label for="anioSeleccionado">Seleccione un Año:</label>
                <select class="form-control" id="anioSeleccionado" name="anio">
                    @php
                    $anioActual = now()->year;
                    $anioInicio = $anioActual - 1;
                    $anioSeleccionado = request('anio', $anioActual);
        
                    for ($anio = $anioInicio; $anio <= $anioActual; $anio++) {
                        $selected = $anioSeleccionado == $anio ? 'selected' : '';
                        echo "<option value='{$anio}' {$selected}>{$anio}</option>";
                    }
                    @endphp
                </select>
            </div>
        
            <div class="form-group mt-3">
                <label for="mesSeleccionado">Seleccione un Mes:</label>
                <select class="form-control" id="mesSeleccionado" name="mes">
                    @php
                    $meses = [
                        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                    ];
                    $mesSeleccionado = request('mes', now()->month);
                    
                    foreach (range(1, 12) as $mes) {
                        $nombreMes = $meses[$mes];
                        $selected = $mesSeleccionado == $mes ? 'selected' : '';
                        echo "<option value='{$mes}' {$selected}>{$nombreMes}</option>";
                    }
                    @endphp
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary mt-3">Mostrar</button>
        </form>
        
        
        

        @if($total_corte_month->isEmpty())
            <p>No hay cortes, ni gastos registrados este mes.</p>
        @else

        @php
            $totalMonto = 0;
        @endphp

        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <h2>Ingresos del mes</h2>
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalIngresos = 0; @endphp
                            @foreach($total_corte_month as $corte)
                                @php
                                    $totalIngresos += $corte->monto;
                                @endphp
                                <tr>
                                    <td>{{ $corte->fecha }}</td>
                                    <td>{{ $corte->monto }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><strong>Total Ingresos</strong></td>
                                <td><strong>{{ $totalIngresos }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <h2>Gastos del mes</h2>
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalGastos = 0; @endphp
                            @foreach($gastosMes as $gasto)
                                @php
                                    $totalGastos += $gasto->monto;
                                @endphp
                                <tr>
                                    <td>{{ $gasto->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $gasto->monto }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><strong>Total Gastos</strong></td>
                                <td><strong>{{ $totalGastos }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Resultado final -->
            <div class="row">
                <div class="col">
                    <h3>Resultado Final</h3>
                    <p><strong>Total Ingresos:</strong> {{ $totalIngresos }}</p>
                    <p><strong>Total Gastos:</strong> {{ $totalGastos }}</p>
                    <p><strong>Balance del Mes:</strong> {{ $totalIngresos - $totalGastos }}</p>
                </div>
            </div>
            
        </div>
        @endif
    </div>


</x-app-layout>
