<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Categorias::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valido = $request->validate([
            'nombre' => ["required", "string"],
            'descripcion' => ["required", "string"],
            'estado' => ["required", "string"],
        ]);
        $nuevo = Categorias::create($valido);
        return $nuevo;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Categorias::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $actualizar = Categorias::findOrFail($id);
        $valido = $request->validate([
            'nombre' => ["required", "string"],
            'descripcion' => ["required", "string"],
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
        $delete = Categorias::findOrFail($id);

        if ($delete) {
            return response()->json(["message" => "Categoria bprrado exitosamente"]);
        } else {
            return response()->json(["error" => "No se encontro el registro"], 404);
        }
    }
}
