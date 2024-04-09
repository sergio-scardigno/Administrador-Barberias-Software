<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar un corte
        </h2>
    </x-slot>


    <div class="container">
            <div class="grid grid-cols-3 gap-4">

        <div class="m-10">
            @include('components.mensaje')
            <form action="{{ route('corte.update', $cortes->id) }}" method="POST">
                @method('patch')
                @csrf
                <div class="shadow ">

                    <label class="block text-sm font-medium text-gray-700">Editar Corte</label>

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
                            <option value="{{ $cliente_totale->id }}">{{ $cliente_totale->nombre }}, {{ $cliente_totale->apellido }}</option>
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
                    <input type="date" name="fecha" id="fecha" value="{{ $cortes->fecha }}"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                    <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                    <input type="number" name="monto" id="monto" value="{{ $cortes->monto }}"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="2" value="{{ $cortes->descripcion }}"
                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                              placeholder="Breve descripción del corte"></textarea>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">




                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm
                                text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>



</x-app-layout>
