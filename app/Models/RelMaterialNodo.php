<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelMaterialNodo extends Model
{

    protected $table = 'rel_material_nodos';


    protected $fillable = [
        'nodo_id',
        'id_material',
        'ip',
        'descripcion',
    ];
    
    public $timestamps = false;


}