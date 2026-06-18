<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index() {
        $asistencias = Asistencia::with('alumno')->get();
        return view('asistencias.index', compact('asistencias'));
    }

    public function store(Request $request) {
        Asistencia::create($request->all());
        return redirect()->route('asistencias.index');
    }
}