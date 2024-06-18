<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClienteCreado extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    /**
     * Crear una nueva instancia de mensaje.
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Construye el mensaje.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cliente creado - Soporte',
        );
    }

    /**
     * Construye el mensaje.
     */
    public function content(): Content
    {
        return new Content(
            view: 'soporte.mails.cliente_creado',
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