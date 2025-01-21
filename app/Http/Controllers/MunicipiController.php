<?php

namespace App\Http\Controllers;

use App\Models\Municipi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Provincia;

class MunicipiController extends Controller
{
    public function index()
    {
        $municipis = Municipi::all();  // o la consulta adecuada
        return view('provincies', compact('municipis'));
    }



    public function provincies()
    {
        // Definir las provincias estáticas
        $provincies = ['Girona', 'Barcelona', 'Tarragona', 'Lleida'];

        // Pasar las provincias a la vista
        return view('provincies', compact('provincies'));
    }

    public function municipisPerProvincia(Request $request, $provincia)
    {
        $itemsPerPage = $request->get('itemsPerPage', 10); // Valor predeterminado: 10

        if ($itemsPerPage === 'all') {
            $municipis = Municipi::where('provincia', $provincia)->get(); // Obtenemos todos
        } else {
            $municipis = Municipi::where('provincia', $provincia)->paginate((int) $itemsPerPage); // Paginación
        }

        return view('municipis.index', compact('municipis', 'provincia'));
    }

    public function indexApi()
    {
        // Obtener todos los municipios con solo las columnas que quieres
        $municipis = Municipi::select('id', 'nom', 'descripcio', 'imatge', 'provincia', 'comarca')->get();

        // Devolver los resultados como JSON
        return response()->json($municipis);
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

        // Validación de los campos
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'comarca' => 'nullable|string|max:255',
            'provincia' => 'required|string|in:Girona,Barcelona,Tarragona,Lleida',
            'imatge' => 'nullable|image|mimes:jpeg,png,gif|max:99999',
        ]);

        // Verificamos si se ha subido una nueva imagen
        if ($request->hasFile('imatge')) {
            // Eliminar la imagen anterior si existe
            if (file_exists(public_path($municipi->imatge))) {
                unlink(public_path($municipi->imatge)); // Elimina el archivo antiguo
            }

            // Nombre del archivo de la imagen
            $mimeType = $request->imatge->getMimeType();
            $extensions = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
            ];
            $imageExtension = $extensions[$mimeType] ?? 'jpg';
            $imageName = $municipi->nom . '.' . $imageExtension;

            // Normalizamos la provincia a minúsculas para evitar crear carpetas con inicial en mayúscula
            $directory = public_path('images/' . strtolower($request->input('provincia')));

            // Verificamos si la carpeta existe, y si no, la creamos
            if (!file_exists($directory)) {
                mkdir($directory, 0775, true);
            }

            // Movemos la imagen a la carpeta
            $request->file('imatge')->move($directory, $imageName);

            // Guardamos la ruta de la imagen en la base de datos
            $municipi->imatge = 'images/' . strtolower($request->input('provincia')) . '/' . $imageName;
        }

        // Actualizamos los demás campos
        $municipi->nom = $request->input('nom');
        $municipi->descripcio = $request->input('descripcio');
        $municipi->comarca = $request->input('comarca');
        $municipi->provincia = $request->input('provincia');
        $municipi->save();

        // Redirigimos con un mensaje de éxito
        return redirect()->route('municipis.provincies')->with('success', 'Municipi actualitzat correctament');
    }
}
