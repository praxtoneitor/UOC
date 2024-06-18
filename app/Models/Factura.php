<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';

    protected $fillable = ['cliente_id', 'nombre_factura'];

    public function cliente()
{
    return $this->belongsTo(Client::class, 'cliente_id');
}

}