<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UsuarioCreado extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;


   
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

   
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Usuario Creado',
        );
    }

    
    public function content(): Content
    {
        return new Content(
            view: 'auth.mails.usuario_creado',
        );
    }

    /**
     * Adjuntos del mensaje.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}