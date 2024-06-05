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

}
