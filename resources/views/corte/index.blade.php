<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Cortes
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-center overflow-x-auto">
            <div class="w-full max-w-6xl">
                <div class="overflow-hidden rounded-lg shadow-lg">
                    <table class="table-auto w-full text-sm text-left bg-white">
                        <thead class="bg-indigo-500 text-white">
                            <tr>
                                <th class="border px-4 py-3 font-semibold">Barbero</th>
                                <th class="border px-4 py-3 font-semibold">Cliente</th>
                                <th class="border px-4 py-3 font-semibold">Monto</th>
                                <th class="border px-4 py-3 font-semibold">Fecha</th>
                                <th class="border px-4 py-3 font-semibold">Descripción</th>
                                <th class="border px-4 py-3 font-semibold">Editar</th>
                                <th class="border px-4 py-3 font-semibold">Borrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listadoCortes as $listadoCorte)
                            <tr class="odd:bg-indigo-100 even:bg-indigo-50">
                                <td class="border px-4 py-2">{{ $listadoCorte->nombre_barbers }}</td>
                                <td class="border px-4 py-2">{{ $listadoCorte->cliente_nombre }},
                                    {{ $listadoCorte->apellido }}</td>
                                <td class="border px-4 py-2 text-right">{{ $listadoCorte->monto }}</td>
                                <td class="border px-4 py-2">{{ $listadoCorte->fecha }}</td>
                                <td class="border px-4 py-2">{{ $listadoCorte->tipo_nombre }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="{{ route('corte.edit', $listadoCorte->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded">
                                        Editar
                                    </a>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <form action="{{ route('corte.destroy', $listadoCorte->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded">
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
</x-app-layout>