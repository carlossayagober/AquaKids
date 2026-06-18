<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Nivel;
use App\Models\Entrenador; // Importante: Debes importar la clase Entrenador
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        // Cargamos la relación con 'coach' para que se vea en el index
        $grupos = Grupo::with(['nivel', 'coach'])->get();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        $niveles = Nivel::all();
        $entrenadores = Entrenador::all(); 
        return view('grupos.create', compact('niveles', 'entrenadores'));
    }

    public function store(Request $request)
    {
        // 1. Validamos incluyendo coach_id
        $request->validate([
            'nombre_grupo' => 'required|string|max:100',
            'horario'      => 'required|string|max:50',
            'nivel_id'     => 'required|exists:niveles,id',
            'coach_id'     => 'required|exists:entrenadores,id', // Validamos que el entrenador exista
        ]);

        // 2. Guardamos todos los datos incluyendo el entrenador
        Grupo::create([
            'nombre_grupo' => $request->nombre_grupo,
            'horario'      => $request->horario,
            'nivel_id'     => $request->nivel_id,
            'coach_id'     => $request->coach_id, // Ahora se guardará correctamente
            'cupo_maximo'  => 15,
        ]);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado con éxito.');
    }
    public function destroy($id)
{
    // 1. Buscamos el grupo
    $grupo = Grupo::findOrFail($id);
    
    // 2. Verificamos si tiene alumnos inscritos
    // Asegúrate de que en tu modelo Grupo.php exista la relación 'inscripciones()'
    if ($grupo->inscripciones()->count() > 0) {
        return redirect()->route('grupos.index')
            ->with('error', 'No puedes eliminar este grupo porque tiene alumnos inscritos. Primero mueve a los alumnos a otro grupo.');
    }
    
    // 3. Si no tiene alumnos, procedemos con el borrado
    $grupo->delete();
    
    return redirect()->route('grupos.index')
        ->with('success', 'Grupo eliminado correctamente.');
}
}