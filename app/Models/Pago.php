<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    // Permitimos que estos campos sean guardados masivamente
    protected $fillable = [
        'alumno_id', 
        'monto', 
        'periodo_pagado', 
        'fecha_pago', 
        'estado_pago'
    ];

    // La relación: Un pago pertenece a un alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}