<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'material'; 
    protected $fillable = ['marca', 'modelo', 'num_serie', 'mac', 'utilizado', 'id'];


    public function nodos()
    {
        return $this->belongsToMany(Nodo::class, 'rel_material_nodos', 'id_material', 'id_nodo');
    }

    // Scopes

    public function scopeMarca($query, $marca)
    {
        if ($marca) {
            return $query->where('marca', 'LIKE', "%$marca%");
        }
    }

    public function scopeModelo($query, $modelo)
    {
        if ($modelo) {
            return $query->where('modelo', 'LIKE', "%$modelo%");
        }
    }

}