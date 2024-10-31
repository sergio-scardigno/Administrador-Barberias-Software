<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pagina de Turnos
        </h2>
    </x-slot>

    <div class="container">
        <h1>Turnos</h1>
        <a href="{{ route('turnos.create') }}">Crear nuevo turno</a>
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Fecha y Hora de Inicio</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($turnos as $turno)
                            <tr>
                                <td>{{ $turno->fecha_hora_inicio }}</td>
                                <td>{{ $turno->cliente->nombre }} {{ $turno->cliente->apellido }}</td>
                                <td>
                                    <a href="{{ route('turnos.edit', $turno) }}"
                                        class="btn btn-primary btn-sm">Editar</a>
                                    <form action="{{ route('turnos.destroy', $turno->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>




        <div id='calendar'></div>

    </div>




    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es', // Establecer el idioma a español
            initialView: 'dayGridMonth', // Vista inicial del calendario mensual
            events: '/turnos/api', // Ruta que devuelve los eventos en formato JSON
            eventClick: function(info) {
                // Puedes usar un alert o modal para mostrar detalles
                alert('Cliente: ' + info.event.title + '\nEmail: ' + info.event.extendedProps
                    .email +
                    '\nTeléfono: ' + info.event.extendedProps.phone);
            },
            eventTimeFormat: { // Formato de la hora de los eventos
                hour: 'numeric',
                minute: '2-digit',
                meridiem: false
            },
            eventDisplay: 'block', // Mostrar eventos como bloques para que ocupen todo el día
            eventStartEditable: false, // Deshabilitar la edición del inicio de los eventos
            eventDurationEditable: false // Deshabilitar la edición de la duración de los eventos
        });
        calendar.render();
    });
    </script>
    </script>
</x-app-layout>