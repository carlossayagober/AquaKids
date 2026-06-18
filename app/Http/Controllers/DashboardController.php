<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Nivel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        // 1. Estadísticas globales rápidas
        $totalAlumnos = Alumno::count();
        $totalNiveles = Nivel::count();
        
        // 2. Alumnos que requieren atención por alertas de salud
        $alumnosConObservaciones = Alumno::whereNotNull('observaciones_medicas')
                                         ->where('observaciones_medicas', '!=', '')
                                         ->get();

        // 3. Conteo de cuántos alumnos hay inscritos en cada nivel de natación
        $nivelesConConteo = Nivel::withCount('alumnos')->get();

        return view('dashboard', compact(
            'totalAlumnos', 
            'totalNiveles', 
            'alumnosConObservaciones', 
            'nivelesConConteo'
        )); 
    }
}