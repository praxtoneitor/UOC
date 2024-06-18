<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nodo extends Model
{
    protected $table = 'nodos';

    protected $fillable = ['nombre', 'geoposicionamiento']; 

    public function material()
    {
        return $this->belongsToMany(Material::class, 'rel_material_nodos', 'id_nodo', 'id_material')->withPivot('ip', 'alias');

    }
}