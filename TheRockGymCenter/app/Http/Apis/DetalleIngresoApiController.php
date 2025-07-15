<?php

namespace App\Http\Controllers;

use App\Models\DetallesIngresos;
use Illuminate\Http\Request;

class DetalleIngresoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DetallesIngresos::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valido = $request->validate([
            'ingreso' => ["required", "integer"],
            'producto_id' => ["required", "integer"],
            'cantidad' => ["required", "integer"],
        ]);
        $nuevo = DetallesIngresos::create($valido);
        return $nuevo;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return DetallesIngresos::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $actualizar = DetallesIngresos::findOrFail($id);
        $valido = $request->validate([
            'ingreso' => ["required", "integer"],
            'producto_id' => ["required", "integer"],
            'cantidad' => ["required", "integer"],
        ]);
        $actualizar->update($valido);
        return $actualizar;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = DetallesIngresos::findOrFail($id);
        if ($delete) {
            return response()->json(["message" => "Detalle de ingreso borrado exitosamente"]);
        } else {
            return response()->json(["error" => "No se encontró el registro"], 404);
        }
    }
}
