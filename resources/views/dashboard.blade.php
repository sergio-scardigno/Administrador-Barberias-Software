<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Control
        </h2>
    </x-slot>

    <div class="container mt-5">

        <div class="row">

            <div class="col-lg-4 mb-4">
                @include('components.mensaje')
                <form action="{{ route('corte.store') }}" method="POST">
                    @method('get')
                    @csrf
                    <div class="shadow ">

                        <label class="block text-sm font-medium text-gray-700">Nuevo corte:</label>

                        <label class="block text-sm font-medium text-gray-700">Profesional a cargo</label>

                        <select id="barbers_id" name="barbers_id" autocomplete="country"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($barbers as $barber)
                            <option value="{{ $barber->id }}">{{ $barber->nombre }}</option>
                            @endforeach
                        </select>


                        <label for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente</label>

                        {{-- Espacio de Trabajo para el buscador de clientes --}}


                        {{--                    <select id="cliente_id" name="cliente_id" autocomplete="cliente" --}}
                        {{--                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"> --}}
                        {{--                        @foreach ($cliente_totales ?? '' as $cliente_totale) --}}
                        {{--                            <option value="{{ $cliente_totale->id }}">{{ $cliente_totale->nombre }}
                        --}}
                        {{--                                , {{ $cliente_totale->apellido }}</option> --}}
                        {{--                        @endforeach --}}
                        {{--                    </select> --}}


                        <select id="cliente_id" name="cliente_id"
                            class="itemName  mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></select>





                        {{-- Fin de Espacio de Trabajo --}}

                        <label for="tipos_id" class="block text-sm font-medium text-gray-700">Tipo de corte: </label>
                        <select id="tipos_id" name="tipos_id" autocomplete="tipos_id"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombres }}</option>
                            @endforeach
                        </select>

                        <label for="medio_de_pago" class="block text-sm font-medium text-gray-700">Medio de pago:
                        </label>
                        <select id="medio_de_pago" name="medio_de_pago" autocomplete="medio_de_pago"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($pagos as $pago)
                            <option value="{{ $pago->id }}">{{ $pago->pagos }}</option>
                            @endforeach
                        </select>


                        <!-- // Promocion checkbox -->
                        <label for="promocion" class="block text-sm font-medium text-gray-700">Promoción:</label>
                        <div class="mt-1">
                            <input type="checkbox" id="promocion" name="promocion"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-600">Marcar si el corte es una promoción</span>
                        </div>


                        <!-- <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                        <input type="date" name="fecha" id="fecha"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"> -->

                        <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                        <input type="number" name="monto" id="monto"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" rows="2"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Breve descripción del corte"></textarea>


                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="col-lg-8">
                <h1>Cortes del dia</h1>
                <div class="grid grid-flow-col auto-cols-max" style="width: 500px;">
                    <div class="table-container" style="height: 400px; overflow-y: auto;">
                        <table class="table-auto custom-table w-full">
                            <thead>
                                <tr>
                                    <!-- <th class="border-2 text-left pr-12 bg-indigo-200">id</th> -->
                                    <th class="border-2 text-left pr-12 bg-indigo-200">Barbero</th>
                                    <th class="border-2 text-left pr-12 bg-indigo-200">Cliente</th>
                                    <th class="border-2 text-left pr-12 bg-indigo-200">Monto</th>
                                    <th class="border-2 text-left pr-12 bg-indigo-200">Fecha</th>
                                    <th class="border-2 text-left bg-indigo-200">Descripción</th>
                                    <th class="border-2 text-left pr-12 bg-indigo-200">Editar</th>
                                    <th class="border-2 text-left pr-12 bg-indigo-200">Borrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                <tr>
                                    <!-- <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cliente->id }}</td> -->
                                    <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cliente->nombre_barbers }}
                                    </td>
                                    <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cliente->cliente_nombre }},
                                        {{ $cliente->apellido }}</td>
                                    <td class="border-2 text-left pr-12 bg-indigo-100">{{ $cliente->monto }}</td>
                                    <td class="border-2 text-left pr-6 bg-indigo-100">{{ $cliente->fecha }}</td>
                                    <td class="border-2 text-left bg-indigo-100">{{ $cliente->tipo_nombre }}</td>
                                    <td>
                                        <a href="{{ route('corte.edit', $cliente->id) }}"
                                            class="bg-indigo-300 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            role="button">Editar</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('corte.destroy', $cliente->id) }}" method="get">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method">
                                            <button
                                                class="bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">BORRAR</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

                                @foreach ($cliente_totales->reverse()->take(10) as $cliente_totale)
                                <tr>
                                    <td class="border-2 text-left pr-12 bg-indigo-100">
                                        {{ ucfirst($cliente_totale->nombre) }},
                                        {{ ucfirst($cliente_totale->apellido) }}</td>

                                    <td>
                                        <a href="{{ route('cliente.edit', $cliente_totale->id) }}"
                                            class="bg-indigo-300 hover:bg-blue-700 text-white font-bold py-0 px-4 rounded"
                                            role="button">Historial</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <select id="cliente_id" name="cliente_id" style="width: 300px;"
                            class="itemName-h mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></select>

                    </div>
                    <div id="turnosHoy">
                        <h3>Turnos de hoy</h3>
                        <ul id="listaTurnos"></ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col">
                    <!-- Contenedor del GIF -->
                    <div style="padding-left: 100px" id="gifContainer"></div>
                </div>
            </div>

        </div>


</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script>
$(document).ready(function() {
    $.ajax({
        url: 'http://barberia.test/turnos/api/hoy',
        method: 'GET',
        dataType: 'json',
        success: function(turnos) {
            if (turnos.length > 0) {
                $('#listaTurnos').empty();
                turnos.forEach(function(turno) {
                    // Mostrar los horarios y los nombres de los turnos en la lista
                    $('#listaTurnos').append('<li>' + turno.start + ' - ' + turno.end +
                        ' : ' + turno.title + '</li>');
                });
            } else {
                $('#listaTurnos').html('<li>No hay turnos para hoy.</li>');
            }
        },
        error: function() {
            $('#listaTurnos').html('<li>Hubo un error al cargar los turnos.</li>');
        }
    });
});
</script>


<script>
$(document).ready(function() {
    $('#cliente_id').change(function() {
        var clienteId = $(this).val();
        if (clienteId) {
            $.ajax({
                url: '/promociones-usuarios/' + clienteId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.tiene_promocion && data.promociones.some(promo => promo.value >
                            0)) {
                        var totalValue = data.promociones.reduce((sum, promo) => sum + promo
                            .value, 0); // Calcula el total de value
                        $('#promocion').prop('checked', true).prop('disabled', false);
                        $('#monto, #descripcion, #medio_de_pago').hide();
                        tienePromocion = true;
                        Swal.fire({
                            title: 'Promoción Vigente',
                            text: 'El cliente tiene ' + data.promociones.length +
                                ' promoción(es) vigente(s) con un total de ' +
                                totalValue + ' crédito(s) restante(s).',
                            icon: 'info',
                            confirmButtonText: 'Entendido'
                        });
                    } else {
                        $('#promocion').prop('checked', false).prop('disabled', true);
                        $('#monto, #descripcion, #medio_de_pago').show();
                        tienePromocion = false;
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al obtener la información de la promoción.',
                        icon: 'error',
                        confirmButtonText: 'Cerrar'
                    });
                }
            });
        } else {
            $('#promocion').prop('checked', false).prop('disabled', true);
            $('#monto, #descripcion, #medio_de_pago').hide();
            tienePromocion = false;
        }
    });

    $('form').submit(function(e) {
        if (tienePromocion) {
            e.preventDefault();
            var clienteId = $('#cliente_id').val();

            $.ajax({
                url: '/actualizar-promocion/' + clienteId,
                type: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    cliente_id: clienteId
                },
                success: function(response) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Se descontó una promoción correctamente en el cliente.',
                        icon: 'success',
                        confirmButtonText: 'Cerrar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(); // Recarga la página
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al actualizar la promoción: ' + xhr.statusText,
                        icon: 'error',
                        confirmButtonText: 'Cerrar'
                    });
                }
            });
        }
    });
});
</script>


<script type="text/javascript">
$('.itemName').select2({
    language: "es",
    placeholder: 'Buscar cliente',
    ajax: {
        url: '/autocomplete',
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
            return {
                results: $.map(data, function(item) {
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

$('.itemName').on('select2:select', function(e) {
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
        processResults: function(data) {
            return {
                results: $.map(data, function(item) {
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

$('.itemName-h').on('select2:select', function(e) {
    var data = $(e.currentTarget).val();

    location.href = '/cliente/' + data;
});
</script>

<script>
const apiKey = "O9oE5Ym1Q0Fy3bPgYzaKAMiRxGSgf3Cy"; // Asegúrate de reemplazar esto con tu clave API real
const searchTerm = "barber";
const limit = 10; // Obtener 10 resultados para tener de dónde elegir
const url = `https://api.giphy.com/v1/gifs/search?api_key=${apiKey}&q=${searchTerm}&limit=${limit}`;

fetch(url)
    .then(response => response.json())
    .then(data => {
        if (data.data.length > 0) {
            // Elegir un GIF al azar de los resultados
            const randomIndex = Math.floor(Math.random() * data.data.length);
            const gifUrl = data.data[randomIndex].images.original.url;

            // Crear un contenedor div para el GIF
            const gifWrapper = document.createElement('div');
            document.getElementById('gifContainer').style.display = 'flex';
            document.getElementById('gifContainer').style.justifyContent = 'flex-end';

            // Crear el elemento img para el GIF
            const imgElement = document.createElement('img');
            imgElement.src = gifUrl;
            imgElement.style.width = '80%'; // Hace que el GIF se ajuste al contenedor
            imgElement.style.height = 'auto';

            // Añadir el img al wrapper, y luego el wrapper al contenedor principal
            gifWrapper.appendChild(imgElement);
            document.getElementById('gifContainer').appendChild(gifWrapper);
        } else {
            console.log('No se encontraron resultados');
        }
    })
    .catch(error => console.error('Error:', error));
</script>