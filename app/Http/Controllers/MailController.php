<?php

// app/Http/Controllers/MailController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function showContactForm()
    {
        return view('contact');
    }

    public function sendEmail(Request $request)
    {
        $email = $request->input('email');
        $message = $request->input('message');

        
        $content = "Mensaje enviado por: $email\n\n$message";

        // Envía el correo electrónico
        Mail::raw($content, function ($message) {
            $message->to('javier.aestrada@gmail.com')
                ->subject('Nuevo mensaje desde el formulario de contacto');
        });

        return redirect()->back()->with('success', '¡El correo electrónico ha sido enviado correctamente!');
    }
}