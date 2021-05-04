<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar un nuevo cliente
        </h2>
    </x-slot>

    <div class="grid grid-cols-3 gap-4">

        <div class="m-10">
            <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
                @method('patch')
                @csrf
                <div class="shadow ">

                    <label class="block text-sm font-medium text-gray-700">Editar Cliente</label>

                    <label class="block text-sm font-medium text-gray-700">Editar Nombre</label>

                    <input type="text" name="nombre" id="nombre" autocomplete="family-name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full
                           shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $cliente->nombre }}">


                    <label class="block text-sm font-medium text-gray-700">Editar Apellido</label>

                    <input type="text" name="apellido" id="apellido" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full
                           shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $cliente->apellido }}">


                    <label class="block text-sm font-medium text-gray-700">Editar correo</label>

                    <input type="email" name="correo" id="correo" autocomplete="family-name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
                           sm:text-sm border-gray-300 rounded-md" value="{{ $cliente->correo }}">


                    <label class="block text-sm font-medium text-gray-700">Editar telefono</label>

                    <input type="number" name="telefono" id="telefono" autocomplete="family-name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
                           sm:text-sm border-gray-300 rounded-md" value="{{ $cliente->telefono }}">


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


</x-app-layout>
