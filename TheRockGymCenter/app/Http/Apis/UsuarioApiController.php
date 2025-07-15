<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuarioApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Usuarios::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valido = $request->validate([
            'cedula' => ["required", "string"],
            'nombre' => ["required", "string"],
            'apellido' => ["required", "string"],
            'email' => ["required", "string"],
            'telefono' => ["required", "string"],
            'estado' => ["required", "string"],
            'fecha_nacimiento' => ["required", "string"],
        ]);
        $nuevo = Usuarios::create($valido);
        return $nuevo;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Usuarios::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $actualizar = Usuarios::findOrFail($id);
        $valido = $request->validate([
            'cedula' => ["required", "string"],
            'nombre' => ["required", "string"],
            'apellido' => ["required", "string"],
            'email' => ["required", "string"],
            'telefono' => ["required", "string"],
            'estado' => ["required", "string"],
            'fecha_nacimiento' => ["required", "string"],
        ]);
        $actualizar->update($valido);
        return $actualizar;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Usuarios::findOrFail($id);
        if ($delete) {
            return response()->json(["message" => "Usuario borrado exitosamente"]);
        } else {
            return response()->json(["error" => "No se encontró el registro"], 404);
        }
    }
}
