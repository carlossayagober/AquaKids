<?php
namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function store(Request $request) 
    {
        // Forzamos valores para cumplir con la estructura NOT NULL de tu tabla
        Pago::create([
            'alumno_id'      => $request->alumno_id,
            'monto'          => $request->monto,
            'periodo_pagado' => 'Mensual', // Valor por defecto necesario
            'estado_pago'    => 'Pagado',
            'fecha_pago'     => date('Y-m-d'),
        ]);
        return back()->with('success', 'Pago registrado');
    }
    public function index() {
    $alumnos = Alumno::with('pagos')->get(); // Asegúrate de tener la relación en el modelo Alumno
    return view('index', compact('alumnos'));
}
}