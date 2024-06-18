<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nodo;
use App\Models\Material;

class Averia extends Model
{
    use HasFactory;

    protected $table = 'averias';

    public function nodo()
    {
        return $this->belongsTo(Nodo::class, 'id_nodo');
    }

    public function equipoSustituido()
    {
        return $this->belongsTo(Material::class, 'susti_A');
    }

    public function equipoNuevo()
    {
        return $this->belongsTo(Material::class, 'susti_B');
    }
}