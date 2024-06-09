<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function subscribe (Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        try {
            $correo = new ContactMailable($request->input('email'));
            Mail::to('subscribe@subscribe.com')->send($correo);
            return response()->json(['message' => 'Correo electrónico enviado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hubo un error al enviar el correo electrónico'], 500);
        }
    }
}
