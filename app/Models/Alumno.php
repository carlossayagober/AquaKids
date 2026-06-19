<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional, pero asegura que conecte bien)
    protected $table = 'alumnos';

    // Lista de campos que permitimos guardar en masa
    protected $fillable = [
        'nombre',
        'apellido',
        'identificacion',
        'edad',
        'fecha_nacimiento',
        'observaciones_medicas',
        'acudiente_nombre',
        'acudiente_telefono',
        'nivel_actual_id', // Permitimos la llave foránea
        'estado',
    ];

    // Relación inversa (Un alumno pertenece a un nivel)
    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_actual_id');
    }

// Relación: Un alumno tiene muchas asistencias
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    // Relación: Un alumno tiene muchos pagos
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }





}