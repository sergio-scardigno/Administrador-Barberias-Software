<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Control
        </h2>
    </x-slot>

    <div class="grid grid-cols-3 gap-4">

        <div class="m-10">
            @include('components.mensaje')
            <form action="{{ route('corte.store') }}" method="POST">
                @method('get')
                {{--                @csrf--}}
                <div class="shadow ">

                    <label class="block text-sm font-medium text-gray-700">Nuevo corte:</label>

                    <label class="block text-sm font-medium text-gray-700">Profesional a cargo</label>

                    <select id="barbers_id" name="barbers_id" autocomplete="country"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach( $barbers as $barber )
                            <option value="{{ $barber->id }}">{{ $barber->nombre }}</option>
                        @endforeach
                    </select>


                    <label for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                    <select id="cliente_id" name="cliente_id" autocomplete="cliente"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach( $cliente_totales as $cliente_totale )
                            <option value="{{ $cliente_totale->id }}">{{ $cliente_totale->nombre }}
                                , {{ $cliente_totale->apellido }}</option>
                        @endforeach
                    </select>

                    <label for="tipos_id" class="block text-sm font-medium text-gray-700">Tipo de corte: </label>
                    <select id="tipos_id" name="tipos_id" autocomplete="tipos_id"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach( $tipos as $tipo )
                            <option value="{{ $tipo->id }}">{{ $tipo->nombres }}</option>
                        @endforeach
                    </select>


                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="fecha" id="fecha"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                    <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                    <input type="number" name="monto" id="monto"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="2"
                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                              placeholder="Breve descripción del corte"></textarea>


                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>


        <div class="m-10">

            <div class="grid grid-flow-col auto-cols-max">
                <table class="table-auto">
                    <thead>
                    <tr>
                        {{--                        <th class="border-2 text-left pr-12 bg-indigo-200">id</th>--}}
                        <th class="border-2 text-left pr-12 bg-indigo-200">Barbero</th>
                        <th class="border-2 text-left pr-12 bg-indigo-200">Cliente</th>
                        <th class="border-2 text-left pr-12 bg-indigo-200">Descripción</th>
                        <th class="border-2 text-left pr-12 bg-indigo-200">Monto</th>
                        <th class="border-2 text-left pr-12 bg-indigo-200">Fecha</th>
                        <th class="border-2 text-left pr-12 bg-indigo-200">Editar</th>
                        <th class="border-2 text-left pr-12 bg-indigo-200">Borrar</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            {{--                            <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cliente->id }}</td>--}}
                            <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cliente->nombre_barbers }}</td>
                            <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cliente->cliente_nombre }}
                                , {{ $cliente->apellido }}</td>
                            <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cliente->tipo_nombre }}</td>
                            <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cliente->monto }}</td>
                            <td class="border-2 text-left pr-6 bg-indigo-100">{{ $cliente->fecha }}</td>
                            <td>
                                <a href="{{ route('corte.edit', $cliente->id) }}"
                                   class="bg-indigo-300 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                   role="button">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('corte.destroy', $cliente->id) }}" method="get">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method">
                                    <button class="bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        BORRAR
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>



            </div>


            <!-- Chart's container -->
            <div id="chart" style="height: 300px;"></div>

            <div class="m-10">
                <div class="grid grid-flow-col auto-cols-max">
                    <table class="table-auto">
                        <thead>
                        <tr>
                            <th class="border-2 text-left pr-12 bg-indigo-200">Cliente</th>
                            <th class="border-2 text-left pr-12 bg-indigo-200">Historial</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($cliente_totales as $cliente_totale)
                            <tr>
                                <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cliente_totale->nombre }}, {{ $cliente_totale->apellido }}</td>

                                <td>
                                    <a href="{{ route('cliente.edit', $cliente_totale->id) }}"
                                       class="bg-indigo-300 hover:bg-blue-700 text-white font-bold py-0 px-4 rounded"
                                       role="button">Historial</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <!-- Charting library -->
            <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
            <!-- Chartisan -->
            <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
            <!-- Your application script -->
            <script>
                const chart = new Chartisan({
                    el: '#chart',
                    url: "@chart('chart')",

                });
            </script>


</x-app-layout>


