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
        $municipis = Municipi::all();
        return view('provincies', compact('municipis'));
    }



    public function provincies()
    {
        $provincies = ['Girona', 'Barcelona', 'Tarragona', 'Lleida'];

        return view('provincies', compact('provincies'));
    }

    public function municipisPerProvincia(Request $request, $provincia)
    {
        $itemsPerPage = $request->get('itemsPerPage', 10);

        if ($itemsPerPage === 'all') {
            $municipis = Municipi::where('provincia', $provincia)->get();
        } else {
            $municipis = Municipi::where('provincia', $provincia)->paginate((int) $itemsPerPage);
        }

        return view('municipis.index', compact('municipis', 'provincia'));
    }

    public function indexApi()
    {
        $municipis = Municipi::select('id', 'nom', 'descripcio', 'imatge', 'provincia', 'comarca')->get();

        return response()->json($municipis);
    }

    public function show($id)
    {
        $municipi = Municipi::findOrFail($id);

        $imatgePath = $municipi->imatge;

        $fullPath = public_path($imatgePath);

        if (!file_exists($fullPath)) {
            $imatgePath = 'images/no_disponible.jpg';
        }

        return view('municipis.show', compact('municipi', 'imatgePath'));
    }

    public function __construct()
    {
        $this->middleware('auth')->only(['edit', 'destroy']);
    }

    public function edit($id)
    {
        $municipi = Municipi::findOrFail($id);

        return view('municipis.edit', compact('municipi'));
    }

    public function update(Request $request, $id)
    {
        $municipi = Municipi::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'comarca' => 'nullable|string|max:255',
            'provincia' => 'required|string|in:Girona,Barcelona,Tarragona,Lleida',
            'imatge' => 'nullable|image|mimes:jpeg,png,gif|max:99999',
        ]);

        if ($request->hasFile('imatge')) {
            if (file_exists(public_path($municipi->imatge))) {
                unlink(public_path($municipi->imatge));
            }

            $mimeType = $request->imatge->getMimeType();
            $extensions = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
            ];
            $imageExtension = $extensions[$mimeType] ?? 'jpg';
            $imageName = $municipi->nom . '.' . $imageExtension;

            $directory = public_path('images/' . strtolower($request->input('provincia')));

            if (!file_exists($directory)) {
                mkdir($directory, 0775, true);
            }

            $request->file('imatge')->move($directory, $imageName);

            $municipi->imatge = 'images/' . strtolower($request->input('provincia')) . '/' . $imageName;
        }

        $municipi->nom = $request->input('nom');
        $municipi->descripcio = $request->input('descripcio');
        $municipi->comarca = $request->input('comarca');
        $municipi->provincia = $request->input('provincia');
        $municipi->save();

        return redirect()->route('municipis.provincies')->with('success', 'Municipi actualitzat correctament');
    }
}
