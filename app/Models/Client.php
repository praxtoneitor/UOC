<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'movil',
        'dni',
        'email',
        'direccion',
        'ciudad',
        'codigo_postal',
        'provincia',
        'servicio_id',
        'estado_id',
        'disponibilidad',
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email');
    }

    // SCOPES
    public function scopeDNI($query, $dni)
    {
        if ($dni) {
            return $query->where('dni', 'LIKE', "%$dni%");
        }
    }
    
    public function scopeApellidos($query, $apellidos)
    {
        if ($apellidos) {
            return $query->where('apellidos', 'LIKE', "%$apellidos%");
        }
    }


}