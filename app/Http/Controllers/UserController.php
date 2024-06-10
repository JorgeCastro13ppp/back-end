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

    public function updateBalance(Request $request, $email)
    {
    // Validar la solicitud
    $request->validate([
        'amount' => 'required|numeric', // Asegúrate de que el monto sea numérico
    ]);

    // Buscar al usuario por su correo electrónico
    $user = User::where('email', $email)->first();

    // Verificar si el usuario fue encontrado
    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // Convertir el balance a un tipo numérico y sumar el monto proporcionado en la solicitud
    $user->balance = floatval($user->balance) + $request->amount;

    // Guardar los cambios en la base de datos
    $user->save();

    // Responder con el usuario actualizado
    return response()->json($user);
    }

    public function subtractBalance(Request $request, $email)
    {
        // Validar la solicitud
        $request->validate([
            'amount' => 'required|numeric', // Asegúrate de que el monto sea numérico
        ]);

        // Buscar al usuario por su correo electrónico
        $user = User::where('email', $email)->first();

        // Verificar si el usuario fue encontrado
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Verificar si el usuario tiene suficiente saldo
        if ($user->balance < $request->amount) {
            return response()->json(['error' => 'Saldo insuficiente'], 400);
        }

        // Restar el monto del balance del usuario
        $user->balance -= $request->amount;
        $user->save();

        // Responder con el usuario actualizado
        return response()->json($user);
    }

    public function deleteUserByEmail($email)
    {
    // Buscar al usuario por su correo electrónico
    $user = User::where('email', $email)->first();

    // Verificar si el usuario fue encontrado
    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // Eliminar al usuario
    $user->delete();

    // Responder con un mensaje de éxito
    return response()->json(['message' => 'Usuario eliminado correctamente']);
    }




}
