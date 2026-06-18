<?php

namespace App\Http\Controllers;

use App\Models\Entrenador;
use Illuminate\Http\Request;

class EntrenadorController extends Controller
{
    public function index() {
        $entrenadores = Entrenador::all();
        return view('entrenadores.index', compact('entrenadores'));
    }

    public function create() {
        return view('entrenadores.create');
    }

    public function store(Request $request) {
        Entrenador::create($request->all());
        return redirect()->route('entrenadores.index')->with('success', 'Entrenador registrado');
    }

    public function edit(Entrenador $entrenador) {
        return view('entrenadores.edit', compact('entrenador'));
    }

    public function update(Request $request, Entrenador $entrenador) {
        $entrenador->update($request->all());
        return redirect()->route('entrenadores.index')->with('success', 'Datos actualizados');
    }

    public function destroy(Entrenador $entrenador) {
        $entrenador->delete();
        return redirect()->route('entrenadores.index')->with('success', 'Entrenador eliminado');
    }
}