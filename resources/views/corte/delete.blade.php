<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cortes borrados
        </h2>
    </x-slot>

    <div class="container">
        <div class="grid grid-cols-12 gap-4">

        <div class="m-10">

            <div class="grid grid-flow-col auto-cols-max">
                <table>
                    <thead class="table-auto">
                    <th class="border-2 text-left pr-12 bg-indigo-200">Fecha de borrado</th>
                    <th class="border-2 text-left pr-12 bg-indigo-200">Barbero</th>
                    <th class="border-2 text-left pr-12 bg-indigo-200">Cliente</th>
                    <th class="border-2 text-left pr-12 bg-indigo-200">Descripción</th>
                    <th class="border-2 text-left pr-12 bg-indigo-200">Monto</th>
                    <th class="border-2 text-left pr-12 bg-indigo-200">Restaurar</th>

                    </thead>
                    @foreach( $cortes_borrados as $cortes_borrado)
                        <tbody>
                        <td class="border-2 text-left pr-6 bg-indigo-100">{{ $cortes_borrado->deleted_at }}</td>
                        <td class="border-2 text-left pr-6 bg-indigo-100">{{ $cortes_borrado->nombre_barbers }}</td>
                        <td class="border-2 text-left pr-6 bg-indigo-100">{{ $cortes_borrado->cliente_nombre }}</td>
                        <td class="border-2 text-left pr-6 bg-indigo-100">{{ $cortes_borrado->descripcion }}</td>
                        <td class="border-2 text-left pr-6 bg-indigo-100">{{ $cortes_borrado->monto }}</td>
                        <td class="border-2 text-left pr-6 bg-indigo-100"><a
                                href="{{ route('restore.delete', $cortes_borrado->id) }}"
                                class="bg-indigo-300 hover:bg-blue-700 text-white font-bold py-0 px-2 rounded"
                                role="button">Restaurar</a>
                        </td>

                        </tbody>
                    @endforeach
                </table>
            </div>


        </div>
    </div>
    </div>




</x-app-layout>
