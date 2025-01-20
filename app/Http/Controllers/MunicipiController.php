<?php

namespace App\Http\Controllers;

use App\Models\Municipi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Provincia;

class MunicipiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10); // Default to 10 items per page
        $municipis = Municipi::paginate($perPage);

        return view('municipis.index', compact('municipis'));
    }


    public function provincies()
    {
        // Definir las provincias estáticas
        $provincies = ['Girona', 'Barcelona', 'Tarragona', 'Lleida'];

        // Pasar las provincias a la vista
        return view('provincies', compact('provincies'));
    }


    public function municipisPerProvincia($provincia)
    {
        // Obtener el número de elementos por página desde el request
        $itemsPerPage = request()->input('itemsPerPage', 10); // 10 es el valor por defecto

        // Obtener los municipios de la provincia seleccionada
        $municipis = Municipi::where('provincia', $provincia)
            ->paginate($itemsPerPage);

        return view('municipis.index', compact('municipis', 'provincia'));
    }




    public function show($id)
    {
        $municipi = Municipi::findOrFail($id);

        // Obtener el valor de la columna 'imatge' desde la base de datos
        $imatgePath = $municipi->imatge;

        // Generar la ruta completa para el archivo de la imagen
        $fullPath = public_path($imatgePath);

        // Verificar si la imagen existe, si no, usar la imagen por defecto
        if (!file_exists($fullPath)) {
            $imatgePath = 'images/no_disponible.jpg'; // Si la imagen no existe, asignar la imagen por defecto
        }

        // Pasar el path de la imagen al view
        return view('municipis.show', compact('municipi', 'imatgePath'));
    }

    public function __construct()
    {
        // Aplica el middleware de autenticación solo a las funciones de edición y eliminación
        $this->middleware('auth')->only(['edit', 'destroy']);
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        $municipi = Municipi::findOrFail($id);

        // No necesitas cargar las provincias ya que no tienes la tabla
        // El campo provincia será un simple texto
        return view('municipis.edit', compact('municipi'));
    }

    public function update(Request $request, $id)
    {
        // Encontramos el municipio por su ID
        $municipi = Municipi::findOrFail($id);

        // Verificamos si se ha subido una nueva imagen
        if ($request->hasFile('imatge')) {
            // Depuración: Verificamos si el archivo se ha subido correctamente
            //dd($request->file('imatge')); // Muestra los detalles del archivo subido

            if ($request->file('imatge')->isValid()) {
                // Nombre del archivo de la imagen (manteniendo el nombre original del municipio)
                $mimeType = $request->imatge->getMimeType();
                $extensions = [
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/gif' => 'gif',
                ];
                $imageExtension = $extensions[$mimeType] ?? 'jpg'; // 'jpg' como valor por defecto
                $imageName = $municipi->nom . '.' . $imageExtension;

                // Establecemos la carpeta de destino
                $directory = public_path('images/' . $request->input('provincia'));

                // Depuración: Verificamos la ruta del directorio
                //dd($directory); // Muestra la ruta completa del directorio

                // Verificamos si la carpeta existe, y si no, la creamos
                if (!file_exists($directory)) {
                    mkdir($directory, 0775, true);  // 0775 es el permiso para crear la carpeta
                }

                // Movemos la imagen a la carpeta
                $request->file('imatge')->move($directory, $imageName);

                // Guardamos la ruta de la imagen en la base de datos
                $municipi->imatge = 'images/' . $request->input('provincia') . '/' . $imageName;

                // Depuración: Verificamos si la ruta se ha guardado correctamente
                //dd($municipi->imatge); // Muestra la ruta de la imagen guardada
            } else {
                return back()->with('error', 'El archivo no es válido');
            }
        }

        // Actualizamos los demás campos
        $municipi->nom = $request->input('nom');
        $municipi->descripcio = $request->input('descripcio');
        $municipi->comarca = $request->input('comarca');
        $municipi->provincia = $request->input('provincia');
        $municipi->save();

        // Redirigimos de nuevo con un mensaje de éxito
        return redirect()->route('municipis.index')->with('success', 'Pueblo actualizado correctamente');
    }
}
