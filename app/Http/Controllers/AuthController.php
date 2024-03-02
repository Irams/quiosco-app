<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function register(RegistroRequest $request){
        // Validar el registro
        $data = $request->validated();

        // Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        // Retornar una respuesta
        return[
            'token' => $user->createToken('token')->plainTextToken,
            'user'  => $user
        ];
    }

    public function login (LoginRequest $request){
        // Validamos los campos
        $data = $request->validated();

        // Revisamos el password
        if(!Auth::attempt($data))
        {
            return response([
                'errors' => ['El email o el password son incorectos']
            ], 422);
        }

        //Autenticar al usuario
        $user = Auth::user();
        return[
            'token' => $user->createToken('token')->plainTextToken,
            'user'  => $user
        ];

    }
    
    public function logout(Request $request){
        $user = $request->user();
        $user -> currentAccessToken()->delete();
        return [
            'user' => null
        ];
    } 
}
