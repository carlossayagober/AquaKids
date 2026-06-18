<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    // Esto obliga a Laravel a buscar la tabla 'entrenadores'
    protected $table = 'entrenadores'; 
    
    protected $fillable = ['nombre', 'apellido', 'especialidad', 'telefono', 'email', 'estado'];
}