<?php

namespace App\Http\Controllers;

use App\Models\Membresias;
use Illuminate\Http\Request;

class MembresiaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Membresias::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valido = $request->validate([
            'nombre' => ["required", "string"],
            'precio' => ["required", "double"],
            'descripcion' => ["required", "string"],
            'fecha_creacion' => ["required", "string"],
            'estado' => ["required", "string"],
        ]);
        $nuevo = Membresias::create($valido);
        return $nuevo;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Membresias::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $actualizar = Membresias::findOrFail($id);
        $valido = $request->validate([
            'nombre' => ["required", "string"],
            'precio' => ["required", "double"],
            'descripcion' => ["required", "string"],
            'fecha_creacion' => ["required", "string"],
            'estado' => ["required", "string"],
        ]);
        $actualizar->update($valido);
        return $actualizar;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Membresias::findOrFail($id);
        if ($delete) {
            return response()->json(["message" => "Membresia borrada exitosamente"]);
        } else {
            return response()->json(["error" => "No se encontró el registro"], 404);
        }
    }
}
