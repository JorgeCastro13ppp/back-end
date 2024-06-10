<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function show($id)
    {
    $user = User::findOrFail($id); // Asume que tienes un modelo User y una tabla users en tu base de datos
    return response()->json($user);
    }

    public function showByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }

    public function updateBalance(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'amount' => 'required|numeric', // Asegúrate de que el monto sea numérico
        ]);

        // Buscar al usuario por su ID
        $user = User::findOrFail($id);

        // Actualizar el balance del usuario
        $user->balance += $request->amount; // Sumar el monto proporcionado en la solicitud
        $user->save();

        // Responder con el usuario actualizado
        return response()->json($user);
    }

}
