<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pagina de Resumenes
        </h2>
    </x-slot>

    <div class="shadow-lg">
        <div class="container m-10">
            <h1 class="text-left">Muestra el balance del dia</h1>
        </div>
    </div>


    <div class="m-10">
        <div class="grid grid-flow-col auto-cols-max">
            <table class="table-auto">
                <thead>
                <tr>
                    <th class="border-2 text-left pr-12 bg-indigo-200">Barbero</th>
                    <th class="border-2 text-left pr-12 bg-indigo-200">Montos</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cortes as $corte)
                    <tr>
                        <td class="border-2 text-left pr-12 bg-indigo-100">{{ $corte->nombre }}</td>
                        <td class="border-2 text-left pr-12 bg-indigo-100">{{ $corte->monto }}</td>
                    </tr>
                @endforeach
                <tfoot>
                <tr>
                    <th class="border-2 text-left pr-12 bg-indigo-100">Total</th>
                    <th class="border-2 text-left pr-12 bg-indigo-100">{{ $suma }}</th>
                </tr>

                <tr>
                    <th class="border-2 text-left pr-12 bg-indigo-100">Para la Barberia</th>
                    <th class="border-2 text-left pr-12 bg-indigo-100">{{ $barberia }}</th>
                </tr>

                <tr>
                    <th class="border-2 text-left pr-12 bg-indigo-100">Para el Barbero</th>
                    <th class="border-2 text-left pr-12 bg-indigo-100">{{ $barbero }}</th>
                </tr>
                </tfoot>
                </tbody>
            </table>

            <div class="grid grid-flow-col auto-cols-max">
                <table class="table-auto">
                    <thead>
                    <tr>
                        <th class="border-2 text-left pr-12 bg-indigo-200">Barbero</th>
                        <th class="border-2 text-left pr-12 bg-indigo-200">Montos</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cortes_twos as $cortes_two)
                        <tr>
                            <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cortes_two->nombre }}</td>
                            <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cortes_two->monto }}</td>
                        </tr>
                    @endforeach
                    <tfoot>
                    <tr>
                        <th class="border-2 text-left pr-12 bg-indigo-100">Total</th>
                        <th class="border-2 text-left pr-12 bg-indigo-100">{{ $sumas_two }}</th>
                    </tr>

                    <tr>
                        <th class="border-2 text-left pr-12 bg-indigo-100">Para la Barberia</th>
                        <th class="border-2 text-left pr-12 bg-indigo-100">{{ $barberia_two }}</th>
                    </tr>

                    <tr>
                        <th class="border-2 text-left pr-12 bg-indigo-100">Para la Barbero</th>
                        <th class="border-2 text-left pr-12 bg-indigo-100">{{ $barbero_two }}</th>
                    </tr>
                    </tfoot>
                    </tbody>
                </table>


            </div>


        </div>


        <div class="space-x-2 bg-blue-50 rounded flex items-start text-blue-600 my-4 max-w-2xl shadow-lg">
            <div class="w-1 self-stretch bg-blue-800">

            </div>
            <div class="flex  space-x-2 p-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.5 5h3l-1 10h-1l-1-10zm1.5 14.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z"/></svg>
                <h3 class="text-blue-800 tracking-wider flex-1">
                    Pago total para la barberia {{ now()->toFormattedDateString() }} <br><a href="#" class="font-semibold underline">({{$total_barberia}} pesos) </a>
                </h3>
            </div>
        </div>


    {{--        <table class="table-auto">--}}
    {{--            <thead>--}}
    {{--            <tr>--}}
    {{--                <th class="border-2 text-left pr-12 bg-indigo-200">Para la Barberia</th>--}}
    {{--            </tr>--}}
    {{--            <tbody>--}}
    {{--            <tr>--}}
    {{--                <th class="border-2 text-left pr-12 bg-indigo-100">{{ $barberia }}</th>--}}
    {{--            </tr>--}}
    {{--            </tbody>--}}
    {{--            </thead>--}}
    {{--        </table>--}}

    {{--        <table class="table-auto">--}}
    {{--            <thead>--}}
    {{--            <tr>--}}
    {{--                <th class="border-2 text-left pr-12 bg-indigo-200">Para el Barbero</th>--}}
    {{--            </tr>--}}
    {{--            <tbody>--}}
    {{--            <tr>--}}
    {{--                <th class="border-2 text-left pr-12 bg-indigo-100">{{ $barbero }}</th>--}}
    {{--            </tr>--}}
    {{--            </tbody>--}}
    {{--            </thead>--}}
    {{--        </table>--}}

    {{--        <table class="table-auto">--}}
    {{--            <thead>--}}
    {{--            <tr>--}}
    {{--                <th class="border-2 text-left pr-12 bg-indigo-200">Para la Barberia</th>--}}
    {{--            </tr>--}}
    {{--            <tbody>--}}
    {{--            <tr>--}}
    {{--                <th class="border-2 text-left pr-12 bg-indigo-100">{{ $barberia_two }}</th>--}}
    {{--            </tr>--}}
    {{--            </tbody>--}}
    {{--            </thead>--}}
    {{--        </table>--}}

    {{--        <table class="table-auto">--}}
    {{--            <thead>--}}
    {{--            <tr>--}}
    {{--                <th class="border-2 text-left pr-12 bg-indigo-200">Para el Barbero</th>--}}
    {{--            </tr>--}}
    {{--            <tbody>--}}
    {{--            <tr>--}}
    {{--                <th class="border-2 text-left pr-12 bg-indigo-100">{{ $barbero_two }}</th>--}}
    {{--            </tr>--}}
    {{--            </tbody>--}}
    {{--            </thead>--}}
    {{--        </table>--}}


</x-app-layout>
