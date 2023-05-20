<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Control
        </h2>
    </x-slot>

    <div class="grid grid-cols-3 gap-4">

        <div class="m-10">
            @include('components.mensaje')
            <form action="{{ route('corte.store') }}" method="POST" class="w-full">
                @method('get')
                <div class="shadow ">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Profesional a cargo</label>
                            <select id="barbers_id" name="barbers_id" autocomplete="country"
                                    class="mt-1 w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach( $barbers as $barber )
                                    <option value="{{ $barber->id }}">{{ $barber->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                            <select id="cliente_id" name="cliente_id" class="itemName mt-1 w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></select>
                        </div>

                        <div>
                            <label for="tipos_id" class="block text-sm font-medium text-gray-700">Tipo de corte: </label>
                            <select id="tipos_id" name="tipos_id" autocomplete="tipos_id"
                                    class="mt-1 w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach( $tipos as $tipo )
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombres }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                            <input type="date" name="fecha" id="fecha"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                            <input type="number" name="monto" id="monto"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="md:col-span-2">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                            <textarea id="descripcion" name="descripcion" rows="2"
                                      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 w-full sm:text-sm border-gray-300 rounded-md"
                                      placeholder="Breve descripción del corte"></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>


        <div class="m-10">


            <div class="grid grid-flow-col " >
                <div class="overflow-x-auto md:overflow-visible">
                    <div class="min-w-full align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Barbero</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Editar</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Borrar</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">{{ $cliente->nombre_barbers }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">{{ $cliente->cliente_nombre }}, {{ $cliente->apellido }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">{{ $cliente->monto }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">{{ $cliente->fecha }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <a href="{{ route('corte.edit', $cliente->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <form action="{{ route('corte.destroy', $cliente->id) }}" method="get">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method">
                                            <button class="text-red-600 hover:text-red-900">BORRAR</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

            </div>



            <div class="ml-2">
                <h1 class="text-lg font-extrabold">Listado de Historial de Clientes</h1>
                <div class="grid grid-flow-col auto-cols-max">
                    <table class="table-auto">
                        <thead>
                        <tr>
                            <th class="border-2 text-left pr-12 bg-indigo-200">Cliente</th>
                            <th class="border-2 text-left pr-12 bg-indigo-200">Historial</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach ($cliente_totales ?? '' as $cliente_totale)
                            <tr>
                                <td class="border-2 text-left pr-12 bg-indigo-100">{{ ucfirst($cliente_totale->nombre) }}, {{ ucfirst($cliente_totale->apellido) }}</td>

                                <td>
                                    <a href="{{ route('cliente.edit', $cliente_totale->id) }}"
                                       class="bg-indigo-300 hover:bg-blue-700 text-white font-bold py-0 px-4 rounded"
                                       role="button">Historial</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <select id="cliente_id" name="cliente_id" style="width: 300px;" class="itemName-h mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></select>


                </div>
            </div>





            <script type="text/javascript">
                $('.itemName').select2({
                    language: "es",
                    placeholder: 'Buscar cliente',
                    ajax: {
                        url: '/autocomplete',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results:  $.map(data, function (item) {
                                    return {
                                        text: item.nombre + ', ' + item.apellido,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });

                $('.itemName').on('select2:select', function (e) {
                    var data = $(e.currentTarget).val();
                    return data;
                });

            </script>

            <script type="text/javascript">
                $('.itemName-h').select2({
                    language: "es",
                    placeholder: 'Buscar cliente',
                    ajax: {
                        url: '/autocomplete',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results:  $.map(data, function (item) {
                                    return {
                                        text: item.nombre + ', ' + item.apellido,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });

                $('.itemName-h').on('select2:select', function (e) {
                    var data = $(e.currentTarget).val();

                    location.href = '/cliente/'+ data;
                });

            </script>



</x-app-layout>


