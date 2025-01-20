<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    public function getByProvincia($provincia)
    {
        return response()->json(['message' => "Província: $provincia"]);
    }

    public function getMunicipi($name)
    {
        return response()->json(['message' => "Municipi: $name"]);
    }
}