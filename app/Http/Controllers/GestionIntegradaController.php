<?php
namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asistencia;
use App\Models\Pago;
use Illuminate\Http\Request;

class GestionIntegradaController extends Controller
{
    public function index(Request $request)
    {
        // 1. Obtener filtros de fecha y grupo (por defecto hoy)
        $fecha = $request->input('fecha', date('Y-m-d'));
        
        // 2. Consulta eficiente: traemos alumnos con sus asistencias y pagos recientes
        $alumnos = Alumno::with(['asistencias' => function($q) use ($fecha) {
            $q->where('fecha_sesion', $fecha);
        }, 'pagos'])->paginate(10);

        // 3. Cálculos para los KPIs del Dashboard
        $presentesHoy = Asistencia::where('fecha_sesion', $fecha)
                        ->where('asistencia', 'Presente')->count();
        $totalAlumnos = Alumno::count();
        $pendientesPago = Pago::where('estado_pago', 'Pendiente')->count();

        return view('gestion.index', compact('alumnos', 'presentesHoy', 'totalAlumnos', 'pendientesPago', 'fecha'));
    }
    
}