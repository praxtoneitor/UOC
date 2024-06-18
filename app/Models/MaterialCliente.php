<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialCliente extends Model
{
    protected $table = 'material_cliente'; 

    protected $fillable = [
        'material_id', 
        'cliente_id',  
    ];


}