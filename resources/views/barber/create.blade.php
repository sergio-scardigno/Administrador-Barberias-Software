<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ingresar un nuevo barber
        </h2>
    </x-slot>

    <div class="grid grid-cols-3 gap-4">

        <div class="m-10">
            <form action="{{ route('barber.store') }}" method="get">
                @method('get')
                {{--                @csrf--}}
                <div class="shadow ">

                    <label class="block text-sm font-medium text-gray-700">Nuevo Profesional:</label>

                    <label class="block text-sm font-medium text-gray-700">Ingresar Nombre y Apellido</label>

                    <input type="text" name="nombre" id="nombre" autocomplete="family-name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">


                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="grid grid-flow-col auto-cols-max m-10">
            <table class="table-auto">
                <thead>
                <tr>
                    <th class="text-left pr-12 border-2 bg-indigo-200">Barberos Registrados</th>
                    <th class="text-left pr-12 border-2 bg-indigo-200">Editar</th>
                    <th class="text-left pr-12 border-2 bg-indigo-200">Borrar</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($barbers as $barber)
                    <tr>
                        <td class="text-left pr-12 border-2 bg-indigo-100">{{ $barber->nombre }}</td>
                        <td class="text-left pr-12 border-2 bg-indigo-100"><a href="{{ route('barber.edit', $barber->id) }}"
                                                                class="bg-indigo-300 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" role="button">Editar</a></td>
                        <td class="text-left pr-12 border-2 bg-indigo-100">
                            <form action="{{ route('barber.destroy', $barber->id) }}" method="get">
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
