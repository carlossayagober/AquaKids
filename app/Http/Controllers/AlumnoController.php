<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Nivel;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Listar alumnos cargando también los niveles para el formulario único (Catálogo)
public function index()
{
    $alumnos = Alumno::all();
    $niveles = Nivel::all(); // <-- Traemos todos los niveles de la BD

    // Pasamos ambas variables a la vista
    return view('alumnos.index', compact('alumnos', 'niveles'));
}

    // Ya no necesitas la vista independiente create.blade.php porque está integrada en el index
    public function create()
    {
        return redirect()->route('alumnos.index');
    }

    // Guardar usando exactamente las columnas validadas de tu BD real
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'                => 'required|string|max:100',
            'apellido'              => 'required|string|max:100',
            'identificacion'        => 'required|string|max:20|unique:alumnos,identificacion',
            'edad'                  => 'required|integer|min:1|max:99',
            'fecha_nacimiento'      => 'required|date',
            'observaciones_medicas' => 'nullable|string',
            'acudiente_nombre'      => 'required|string|max:150',
            'acudiente_telefono'    => 'required|string|max:20',
            'nivel_actual_id'       => 'required|exists:niveles,id', 
        ]);

        Alumno::create($validated);

        return redirect()->route('alumnos.index')->with('success', '¡Alumno registrado con éxito!');
    }

    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        $niveles = Nivel::all();
        return view('alumnos.edit', compact('alumno', 'niveles'));
    }

    // Actualizado para usar las columnas reales de la BD y evitar errores futuros
    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);

        $validated = $request->validate([
            'nombre'                => 'required|string|max:100',
            'apellido'              => 'required|string|max:100',
            'identificacion'        => 'required|string|max:20|unique:alumnos,identificacion,' . $alumno->id,
            'edad'                  => 'required|integer|min:1|max:99',
            'fecha_nacimiento'      => 'required|date',
            'observaciones_medicas' => 'nullable|string',
            'acudiente_nombre'      => 'required|string|max:150',
            'acudiente_telefono'    => 'required|string|max:20',
            'nivel_actual_id'       => 'required|exists:niveles,id',
        ]);

        $alumno->update($validated);

        return redirect()->route('alumnos.index')->with('success', '¡Datos del alumno actualizados!');
    }

    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();

        return redirect()->route('alumnos.index')->with('success', 'Alumno dado de baja correctamente.');
    }
}