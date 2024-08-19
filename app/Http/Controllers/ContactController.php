<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Envoyer l'e-mail
            Mail::to('riouch.souad@gmail.com')->send(new ContactMail($validatedData));

            // Rediriger l'utilisateur avec un message de succès
            return redirect()->back()->with('success', 'Votre message a été envoyé avec succès!');
        
        } catch (Exception $e) {
            // Rediriger l'utilisateur avec un message d'erreur
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer plus tard.');
        }
    }
}
