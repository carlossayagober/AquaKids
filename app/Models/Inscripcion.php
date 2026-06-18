<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $fillable = [
        'alumno_id', 
        'grupo_id', 
        'fecha_inscripcion', 
        'estado'
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}