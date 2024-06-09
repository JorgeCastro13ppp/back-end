<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    //
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->input('email');

        Mail::send([], [], function ($message) use ($email) {
            $message->to($email)
                    ->subject('Subscription Confirmation')
                    ->setBody('Thank you for subscribing!', 'text/html');
        });

        return response()->json(['message' => 'Email sent successfully'], 200);
    }
}
