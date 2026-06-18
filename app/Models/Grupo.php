<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

    protected $fillable = [
        'nombre_grupo',
        'horario',
        'nivel_id',
        'coach_id',
        'cupo_maximo'
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id');
    }

    public function entrenador()
    {
        return $this->belongsTo(Entrenador::class, 'coach_id');
    }
    // AGREGA ESTO: Esto hace que 'coach' sea lo mismo que 'entrenador'
public function coach()
{
    return $this->entrenador();
}
public function getNombreEntrenadorAttribute()
{
    return $this->entrenador ? $this->entrenador->nombre : 'Sin asignar';
}
public function inscripciones()
{
    return $this->hasMany(Inscripcion::class, 'grupo_id');
}
}