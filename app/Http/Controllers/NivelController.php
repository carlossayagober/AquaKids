<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    // 1. Listar todos los niveles
    public function index()
    {
        $niveles = Nivel::all();
        return view('niveles.index', compact('niveles'));
    }

    // 2. Mostrar el formulario de creación
    public function create()
    {
        return view('niveles.create');
    }

    // 3. Guardar el nuevo nivel en la BD
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'requisitos' => 'nullable|string',
        ]);

        Nivel::create($request->all());

        return redirect()->route('niveles.index')->with('success', '¡Nivel creado exitosamente!');
    }

    // 4. Mostrar formulario de edición
    public function edit($id)
    {
        $nivel = Nivel::findOrFail($id);
        return view('niveles.edit', compact('nivel'));
    }

    // 5. Actualizar los datos del nivel
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'requisitos' => 'nullable|string',
        ]);

        $nivel = Nivel::findOrFail($id);
        $nivel->update($request->all());

        return redirect()->route('niveles.index')->with('success', '¡Nivel actualizado correctamente!');
    }

    // 6. Eliminar un nivel
    public function destroy($id)
    {
        $nivel = Nivel::findOrFail($id);
        $nivel->delete();

        return redirect()->route('niveles.index')->with('success', 'Nivel eliminado correctamente.');
    }
}