<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Barbero
        </h2>
    </x-slot>

    <div class="grid grid-cols-3 gap-4">

        <div class="m-10">
            <form action="{{ route('barber.update', $barber->id) }}" method="POST">
                @method('patch')
                @csrf
                <div class="shadow ">

                    <label class="block text-sm font-medium text-gray-700">Nuevo Profesional:</label>

                    <label class="block text-sm font-medium text-gray-700">Ingresar Nombre y Apellido</label>

                    <input type="text" name="nombre" id="nombre" autocomplete="family-name"
                           value="{{ $barber->nombre }}"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">


                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>


    </div>

</x-app-layout>
