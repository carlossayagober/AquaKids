<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Alumno;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index() {
        $pagos = Pago::with('alumno')->get();
        $total = $pagos->sum('monto');
        return view('pagos.index', compact('pagos', 'total'));
    }

    public function store(Request $request) {
        Pago::create($request->all());
        return redirect()->route('pagos.index');
    }
}