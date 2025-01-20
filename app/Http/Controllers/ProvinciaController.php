<?php

namespace App\Http\Controllers;

use App\Models\Municipi;

class ProvinciaController extends Controller
{
    // Función para obtener todas las provincias
    public function index()
    {
        // Obtener las provincias únicas (sin duplicados) de la tabla 'municipis'
        $provincies = Municipi::select('provincia')->distinct()->get();

        if ($provincies->isEmpty()) {
            return response()->json(['error' => 'No hi ha provincies disponibles'], 404);
        }

        // Retornar la vista con las provincias
        return view('provincies', compact('provincies'));
    }

    // Función para obtener municipios por provincia
    public function municipisPerProvincia($provincia)
    {
        // Obtener los municipios correspondientes a la provincia indicada
        $municipis = Municipi::where('provincia', 'LIKE', '%'.$provincia.'%')->get();

        if ($municipis->isEmpty()) {
            return response()->json(['error' => 'No hi ha municipis per a aquesta província'], 404);
        }

        // Retornar la vista con los municipios de esa provincia
        return view('municipisPerProvincia', compact('municipis', 'provincia'));
    }
}
