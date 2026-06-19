<?php
namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Grupo; // Importa el modelo Grupo
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function store(Request $request) 
    {
        // 1. Buscamos si el grupo existe. Si no, usamos el primer grupo disponible
        $grupo = Grupo::first(); 
        $grupo_id = $grupo ? $grupo->id : 1; 

        Asistencia::create([
            'alumno_id'    => $request->alumno_id,
            'grupo_id'     => $grupo_id, // Usamos el ID real encontrado
            'asistencia'   => $request->asistencia, // Asegúrate que el select envíe 'Asistió' o 'Faltó'
            'fecha_sesion' => date('Y-m-d'),
        ]);

        return back()->with('success', 'Asistencia registrada correctamente');
    }
}