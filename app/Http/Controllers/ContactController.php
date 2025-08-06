<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Envoi d'un email au support
        Mail::raw(
            "Message de contact reçu :\n" .
            "Nom : {$validated['first_name']} {$validated['last_name']}\n" .
            "Email : {$validated['email']}\n" .
            "Sujet : {$validated['subject']}\n" .
            "Message :\n{$validated['message']}",
            function ($mail) use ($validated) {
                $mail->to('support@rdvmedical.tn')
                     ->subject('Nouveau message de contact : ' . $validated['subject']);
            }
        );

        return back()->with('success', 'Votre message a bien été envoyé. Merci de nous avoir contactés !');
    }
} 