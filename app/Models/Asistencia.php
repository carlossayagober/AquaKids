<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'alumno_id',
        'grupo_id',
        'fecha_sesion',
        'asistencia',
        'observaciones_progreso'
    ];

    // Un registro de asistencia pertenece a un alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    // También pertenece a un grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}