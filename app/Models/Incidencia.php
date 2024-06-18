<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\User;


class Incidencia extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_cliente',
        'id_tecnico',
        'via_comunicacion',
        'tipo_incidencia',
        'necesita_visita',
        'fecha_visita',
        'descripcion',
        'solucion',
        'estado',
    ];

    // Define las relaciones con los modelos relacionados
    public function cliente()
    {
        return $this->belongsTo(Client::class, 'id_cliente');
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'id_tecnico');
    }
}