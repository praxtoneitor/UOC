<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevaIncidenciaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;
    public $estado;


    public function __construct($cliente, $estado)
    {
        $this->estado = $estado;
        $this->cliente = $cliente;
    }


    public function build()
    {
        return $this->view('soporte.mails.nueva_incidencia')
            ->subject('Sistema de Incidencias - Notificación');
    }
}