<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipi;

class AdminController extends Controller
{
    public function update(Request $request, $id)
    {
        $token = $request->header('Authorization');
        if ($token !== 'clau-secreta') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $municipi = Municipi::findOrFail($id);

        $municipi->update($request->all());

        return response()->json(['success' => 'Municipi updated'], 200);
    }
}
