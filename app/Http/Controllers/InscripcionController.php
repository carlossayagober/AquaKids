<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Alumno;
use App\Models\Grupo;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index() 
{
    // Aquí es donde conectamos los puntos:
    // 'grupo.entrenador' es la relación que definimos en el Modelo Grupo
    $inscripciones = Inscripcion::with(['alumno', 'grupo.nivel', 'grupo.entrenador'])->get();
    
    $activasCount = $inscripciones->where('estado', 'Activa')->count();
    
    return view('inscripciones.index', compact('inscripciones', 'activasCount'));
}

    public function create()
    {
        $alumnos = Alumno::all();
        $grupos = Grupo::with(['nivel', 'entrenador'])->get();

        return view('inscripciones.create', compact('alumnos', 'grupos'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id'         => 'required|exists:alumnos,id',
            'grupo_id'          => 'required|exists:grupos,id',
            'fecha_inscripcion' => 'required|date',
            'estado'            => 'required|in:Activa,Inactiva',
        ]);

        Inscripcion::create($request->all());

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción registrada con éxito.');
    }

    public function destroy($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->delete();
        return redirect()->route('inscripciones.index')->with('success', 'Eliminado correctamente.');
    }
}