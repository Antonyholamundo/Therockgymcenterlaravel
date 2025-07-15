<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Ventas::all();
        return view('ventas.ventas', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ventas.ventas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cliente' => 'required|string|max:255',
            'vendedor' => 'required|string|max:255',
            'producto' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'fecha_venta' => 'required|date',
            'pagado' => 'required|in:Pagado,Pendiente',
            'fecha_pago' => 'nullable|date|required_if:pagado,==,Pagado'
        ], [
            'fecha_pago.required_if' => 'La fecha de pago es requerida cuando el estado es Pagado'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Ventas::create([
            'cliente' => $request->cliente,
            'vendedor' => $request->vendedor,
            'producto' => $request->producto,
            'precio' => $request->precio,
            'fecha_venta' => $request->fecha_venta,
            'pagado' => $request->pagado,
            'fecha_pago' => $request->pagado == 'Pagado' ? $request->fecha_pago : null
        ]);

        return redirect()->route('ventas.index')
            ->with('success', 'Venta creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ventas $venta)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ventas $venta)
    {
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ventas $venta)
    {
        $validator = Validator::make($request->all(), [
            'cliente' => 'required|string|max:255',
            'vendedor' => 'required|string|max:255',
            'producto' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'fecha_venta' => 'required|date',
            'pagado' => 'required|in:Pagado,Pendiente',
            'fecha_pago' => 'nullable|date|required_if:pagado,==,Pagado'
        ], [
            'fecha_pago.required_if' => 'La fecha de pago es requerida cuando el estado es Pagado'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $venta->update([
            'cliente' => $request->cliente,
            'vendedor' => $request->vendedor,
            'producto' => $request->producto,
            'precio' => $request->precio,
            'fecha_venta' => $request->fecha_venta,
            'pagado' => $request->pagado,
            'fecha_pago' => $request->pagado == 'Pagado' ? $request->fecha_pago : null
        ]);

        return redirect()->route('ventas.index')
            ->with('success', 'Venta actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ventas $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')
            ->with('success', 'Venta eliminada correctamente');
    }
}