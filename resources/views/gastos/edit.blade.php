<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <h1>Gastos</h1>
            {{-- Contenido de tu vista aquí --}}

        </div>
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="container">
                    <h2>Editar Gasto</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('gastos.update', $gasto->id) }}" method="POST">
                        @csrf <!-- Protección contra CSRF -->
                        @method('PUT') <!-- Simula un método PUT para la actualización -->
                    
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $gasto->nombre }}" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="monto">Monto:</label>
                            <input type="number" class="form-control" id="monto" name="monto" value="{{ $gasto->monto }}" required step="any">
                        </div>
                    
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $gasto->fecha ? $gasto->fecha->format('Y-m-d') : '' }}">
                        </div>
                    
                        <div class="form-group">
                            <label for="categoria">Categoría:</label>
                            <select class="form-control" id="categoria" name="categoria">
                                <option value="">Seleccione una</option>
                                <option value="comida" {{ $gasto->categoria == 'comida' ? 'selected' : '' }}>Comida</option>
                                <option value="servicios" {{ $gasto->categoria == 'servicios' ? 'selected' : '' }}>Servicios</option>
                                <option value="salud" {{ $gasto->categoria == 'salud' ? 'selected' : '' }}>Salud</option>
                                <option value="ocio" {{ $gasto->categoria == 'ocio' ? 'selected' : '' }}>Ocio</option>
                                <!-- Agrega más opciones según sea necesario -->
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ $gasto->descripcion }}</textarea>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Actualizar Gasto</button>
                    </form>
                    
                </div>
            </div>

            <div class="col">
                <h5>Ultimos 10 gastos</h5>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gastos as $gasto)
                            <tr>
                                <td>{{ $gasto->nombre }}</td>
                                <td>{{ $gasto->created_at }}</td> <!-- Asumiendo que $gasto tiene una propiedad 'fecha' -->
                                <td>{{ $gasto->categoria }}</td> <!-- Asumiendo que $gasto tiene una propiedad 'categoria' -->
                                <td>
                                    <!-- Botón Editar -->
                                    <button class="btn btn-primary" onclick="location.href='{{ route('gastos.edit', $gasto->id) }}'">Editar</button>
                                    <!-- Botón Borrar -->
                                    <!-- Asegúrate de tener un método para manejar la eliminación en tu controlador -->
                                    <form action="{{ route('gastos.destroy', $gasto->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer borrar este gasto?')">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>

    </div>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const fechaInput = document.getElementById('fecha');
        const hoy = new Date();
        const fechaHoy = hoy.toISOString().split('T')[0];
        fechaInput.value = fechaHoy;
    });
</script>