<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    // Vinculamos el modelo con tu tabla en plural de la migración
    protected $table = 'niveles';

    // Campos que permitiremos rellenar desde los formularios
    protected $fillable = ['nombre', 'descripcion', 'requisitos'];

    /**
     * RELACIÓN: Un nivel tiene muchos alumnos inscritos.
     */
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'nivel_actual_id');
    }
}