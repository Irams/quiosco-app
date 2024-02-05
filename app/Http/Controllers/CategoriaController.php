<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CategoriaCollection;
use App\Models\categoria;

class CategoriaController extends Controller
{
    public function index(){
        // return response()->json(['categorias' => Categoria::all()]);
        return new CategoriaCollection(categoria::all());
    }
}
