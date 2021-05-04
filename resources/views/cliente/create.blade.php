<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear un nuevo cliente
        </h2>
    </x-slot>

    <div class="grid grid-cols-3 gap-4">

        <div class="m-10">
            <form action="{{ route('cliente.store') }}" method="get">
                @method('get')
                {{--                @csrf--}}
                <div class="shadow ">

                    <label class="block text-sm font-medium text-gray-700">Nuevo Cliente:</label>

                    <label class="block text-sm font-medium text-gray-700">Ingresar Nombre</label>

                    <input type="text" name="nombre" id="nombre" autocomplete="family-name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full
                           shadow-sm sm:text-sm border-gray-300 rounded-md">


                    <label class="block text-sm font-medium text-gray-700">Ingresar Apellido</label>

                    <input type="text" name="apellido" id="apellido" autocomplete="family-name">


                    <label class="block text-sm font-medium text-gray-700">Ingresar correo</label>

                    <input type="email" name="correo" id="correo" autocomplete="family-name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
                           sm:text-sm border-gray-300 rounded-md">


                    <label class="block text-sm font-medium text-gray-700">Ingresar telefono</label>

                    <input type="number" name="telefono" id="telefono" autocomplete="family-name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
                           sm:text-sm border-gray-300 rounded-md">


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

        <div class="grid grid-flow-col auto-cols-max m-10">
            <table class="table-auto">
                <thead>
                <tr>
                    <th>Nombre y Apellido</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nombre }}, {{ $cliente->apellido }}</td>
                        <td>{{ $cliente->correo }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td><a href="{{ route('cliente.edit', $cliente->id) }}"
                               class="btn btn-secondary" role="button">Editar</a></td>
                        <td>
                            <form action="{{ route('cliente.destroy', $cliente->id) }}" method="get">
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


    </div>

</x-app-layout>
