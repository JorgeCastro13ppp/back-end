<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    //
    public function subscribe(Request $request, $email)
    {
        try {
            Mail::send([], [], function ($message) use ($email) {
                $message->to($email)
                        ->subject('Subscription Confirmation')
                        ->setBody('Thank you for subscribing!', 'text/html');
            });

            return response()->json(['message' => 'Email sent successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            return response()->json(['message' => 'Error sending email'], 500);
        }
    }
}
