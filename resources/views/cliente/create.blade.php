<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear un nuevo cliente
        </h2>
    </x-slot>

    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 m-10">
            <div class="row">
                <div class="col-4">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 m-10">
                        @include('components.mensaje')
                        <form action="{{ route('cliente.store') }}" method="get" class="shadow-lg p-5 bg-white rounded-lg">
                            {{-- @csrf --}}
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Ingresar Nombre</label>
                                    <input type="text" name="nombre" id="nombre" autocomplete="family-name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full
                                        shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                
                                <div>
                                    <label for="apellido" class="block text-sm font-medium text-gray-700">Ingresar Apellido</label>
                                    <input type="text" name="apellido" id="apellido" autocomplete="family-name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full
                                        shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                
                                <div>
                                    <label for="correo" class="block text-sm font-medium text-gray-700">Ingresar correo</label>
                                    <input type="email" name="correo" id="correo" autocomplete="family-name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
                                        sm:text-sm border-gray-300 rounded-md">
                                </div>
                
                                <div>
                                    <label for="telefono" class="block text-sm font-medium text-gray-700">Ingresar telefono</label>
                                    <input type="number" name="telefono" id="telefono" autocomplete="family-name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
                                        sm:text-sm border-gray-300 rounded-md">
                                </div>
                
                                <div class="text-right">
                                    <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm
                                            text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
                                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 m-10">
                        <table class="table-auto">
                            <thead class="bg-indigo-200">
                                <tr>
                                    <th class="px-4 py-2 text-left">Nombre y Apellido</th>
                                    <th class="px-4 py-2 text-left">Correo</th>
                                    <th class="px-4 py-2 text-left">Telefono</th>
                                    <th class="px-4 py-2 text-left">Editar</th>
                                    <th class="px-4 py-2 text-left">Borrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                <tr class="bg-indigo-100">
                                    <td class="px-4 py-2">{{ $cliente->nombre }}, {{ $cliente->apellido }}</td>
                                    <td class="px-4 py-2">{{ $cliente->correo }}</td>
                                    <td class="px-4 py-2">{{ $cliente->telefono }}</td>
                                    <td class="px-4 py-2"><a href="{{ route('cliente.edit', $cliente->id) }}" class="bg-indigo-300 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a></td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('cliente.destroy', $cliente->id) }}" method="get">
                                            @csrf
                                            <button class="bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Borrar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>     
    </div>

</x-app-layout>
