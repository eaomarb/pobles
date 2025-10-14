<?php

namespace App\Http\Controllers;

use App\Models\Municipi;

class ProvinciaController extends Controller
{
    public function index()
    {
        $provincies = Municipi::select('provincia')->distinct()->get();

        if ($provincies->isEmpty()) {
            return response()->json(['error' => 'No hi ha provincies disponibles'], 404);
        }

        return view('provincies', compact('provincies'));
    }

    public function municipisPerProvincia($provincia)
    {
        $municipis = Municipi::where('provincia', 'LIKE', '%'.$provincia.'%')->get();

        if ($municipis->isEmpty()) {
            return response()->json(['error' => 'No hi ha municipis per a aquesta província'], 404);
        }

        return view('municipisPerProvincia', compact('municipis', 'provincia'));
    }
}
