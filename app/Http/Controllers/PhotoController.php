<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Muestra el formulario para cargar una nueva foto.
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Almacena una nueva foto en la base de datos y el archivo en el almacenamiento.
     */
    public function store(Request $request)
    {
        // Validación del formulario
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'required|image|max:10240', // 10MB Max
        ]);
    
        // Almacenar la imagen en la carpeta 'img/cortes' del disco 'public'
        $path = $request->file('photo')->store('img/cortes', 'public');
    

        // dd($path);

        // Crear el registro en la base de datos
        Photo::create([
            'title' => $request->title,
            'description' => $request->description,
            'path' => $path,
        ]);
    
        return redirect('/photos');
    }
    

    /**
     * Muestra el muestrario de fotos.
     */
    public function index()
    {
        $photos = Photo::all();
        return view('photos.index', compact('photos'));
    }


    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        // Soft delete del registro en la base de datos
        $photo->delete();

        // Redirigir al usuario a la página del muestrario de fotos con un mensaje
        return redirect('/photos')->with('success', 'Foto eliminada correctamente.');
    }
}
