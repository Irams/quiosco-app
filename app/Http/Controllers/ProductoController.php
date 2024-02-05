<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Resources\ProductoCollection;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProductoCollection(Producto::where('disponible', 1)->orderBy('id', 'DESC')->get());
        //Si quisieramos paginar los resultados de 10 en 10 y mostrar solo los disponibles:
        // return new ProductoCollection(Producto::where('disponible', 1)->orderBy('id', 'DESC')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
