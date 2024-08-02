<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        // Para ver todos los request
        // $input = $request->all();

        $imagen = $request->file('file');

        // Genero un identificador único para cada imagen
        $nombre_imagen = Str::uuid() . "." . $imagen->extension();

        // Manejo de la imagen con Intervention Image
        $imagen_servidor = Image::make($imagen);
        // Defino tamaño de la imagen
        $imagen_servidor->fit(1000, 1000);
        // Guardo la imagen
        $imagen_path = public_path('uploads') . '/' . $nombre_imagen;
        $imagen_servidor->save($imagen_path);
 
        return response()->json(['imagen' => $nombre_imagen]);
    }
}
