<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alta extends Model
{
    protected $table = 'altas'; // Nombre de la tabla

    protected $primaryKey = 'id'; // Nombre de la clave primaria

    protected $fillable = [
        'id_cliente', // Clave externa
        'observaciones',
        'rssi',
        'test',
    ];

    // Relación con la tabla clientes
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}