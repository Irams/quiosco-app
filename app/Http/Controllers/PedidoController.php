<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoCollection;
use App\Models\Pedido;
use App\Models\PedidoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PedidoCollection(Pedido::with('user')->with('productos')->where('estado', 0)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Almacenar un pedido
        $pedido = new Pedido;
        $pedido->user_id = Auth::user()->id;
        $pedido->total = $request->total;
        $pedido->save();

        //Obtener el ID del pedido
        $id = $pedido->id;

        //Obtener los productos
        $productos = $request->productos;

        //Formatear arreglo con Ids y cantidades
        $pedido_producto = [];

        foreach($productos as $producto){
            $pedido_producto[] = [
                'pedido_id' => $id,
                'producto_id' => $producto['id'], 
                'cantidad' => $producto['cantidad'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now() 
            ];
        }

        //Almacenar en BD
        PedidoProducto::insert($pedido_producto);

        return [
            'message' => 'Pedido realizado correctamente, estará listo en unos minutos!'
            // 'productos' => $request->prductos
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //Para completar la orden cmabiamos el estado del pedido a 1
        $pedido->estado=1;
        //Lo guardamos en la BD
        $pedido->save();
        return [
            'pedido' => $pedido
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
