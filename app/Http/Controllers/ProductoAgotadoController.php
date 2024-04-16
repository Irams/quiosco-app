<?php

namespace App\Http\Controllers;

use App\Models\ProductoAgotado;
use Illuminate\Http\Request;

use App\Http\Resources\ProductoAgotadoCollection;

class ProductoAgotadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return new ProductoAgotadoCollection(ProductoAgotado::where('disponible', 0)->orderBy('id', 'DESC')->get());
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
    public function show(ProductoAgotado $productoAgotado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductoAgotado $productoAgotado)
    {
        //
        $productoAgotado->disponible = 1;
        $productoAgotado->save();

        return [
            'producto' => $productoAgotado
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductoAgotado $productoAgotado)
    {
        //
    }
}
