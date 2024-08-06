<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pagina de Resumenes
        </h2>
    </x-slot>

    <div class="container mt-3">
        <h1>Cortes del Mes</h1>

        <form action="{{ route('resumen') }}" method="GET">
            <!-- Selección de Año -->
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
        
            <!-- Selección de Mes -->
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
        
            <!-- Selección de Día -->
            <div class="form-group mt-3">
                <label for="diaSeleccionado">Seleccione un Día:</label>
                <select class="form-control" id="diaSeleccionado" name="dia">
                    @php
                    $diaSeleccionado = request('dia', now()->day);
                    for ($dia = 1; $dia <= 31; $dia++) {
                        $selected = $diaSeleccionado == $dia ? 'selected' : '';
                        echo "<option value='{$dia}' {$selected}>{$dia}</option>";
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
                    <h2>Ingresos del día</h2>
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalIngresosDia = 0; @endphp
                            @foreach($ingresosDelDia as $ingreso)
                                @php
                                    $totalIngresosDia += $ingreso->monto;
                                @endphp
                                <tr>
                                    <td>{{ $ingreso->fecha }}</td>
                                    <td>{{ $ingreso->monto }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><strong>Total Ingresos del Día</strong></td>
                                <td><strong>{{ $totalIngresosDelDia }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
                            @foreach($total_corte_month as $corte)
                                <tr>
                                    <td>{{ $corte->fecha }}</td>
                                    <td>{{ $corte->monto }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><strong>Total Ingresos del Mes</strong></td>
                                <td><strong>{{ $totalIngresosMes }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <h3>Resultado Final</h3>
                    <p><strong>Total Ingresos del Día:</strong> {{ $totalIngresosDelDia }}</p>
                    <p><strong>Total Ingresos del Mes:</strong> {{ $totalIngresosMes }}</p>
                    <p><strong>Total Gastos del Mes:</strong> {{ $totalGastos }}</p>
                    <p><strong>Balance del Mes:</strong> {{ $totalIngresosMes - $totalGastos }}</p>
                </div>
            </div>
        </div>

        @endif

        <div class="row">
            <div class="col">
                <h2>Cantidad de Cortes por Día</h2>
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cantidad de Cortes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cortesPorDia as $corte)
                            <tr>
                                <td>{{ $corte->fecha }}</td>
                                <td>{{ $corte->cantidad }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><strong>Total de Cortes en el Mes</strong></td>
                            <td><strong>{{ $totalCortesMes }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




</x-app-layout>
