<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pagina de Cortes
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-3">    
                <div class="container mt-3">
                    <h3>Subir una Nueva Foto</h3>
                    <form action="/photos" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-1">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Título de la foto">
                        </div>
                        <div class="form-group mt-1">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Descripción de la foto"></textarea>
                        </div>
                        <div class="form-group mt-1">
                            <label for="photo">Foto</label>
                            <input type="file" class="form-control-file" id="photo" name="photo">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Subir Foto</button>
                    </form>
                </div>
            </div>
            <div class="col-9">
                <div class="container mt-3">
                    <h3>Muestrario de Cortes de Pelo</h3>
                    <div class="row">
                        @foreach ($photos as $photo)
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <img src="{{ asset($photo->path) }}" class="bd-placeholder-img card-img-top" alt="{{ $photo->title }}">
                                    <div class="card-body">
                                        <p class="card-text">{{ $photo->title }}</p>
                                        <p class="card-text">{{ $photo->description }}</p>
                                        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                </div>

            </div>
        </div>
    </div>





</x-app-layout>