@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="absolute top-20 right-8 bg-emerald-500 text-white px-4 py-3 rounded-lg shadow-md flex items-center gap-2 z-50 animate-bounce text-xs font-semibold">
        <span class="material-symbols-outlined">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="flex w-full h-[calc(100vh-120px)] gap-6 items-start overflow-hidden p-1">

    <div class="w-80 min-w-[320px] max-w-[320px] bg-white rounded-xl border border-outline-variant flex flex-col h-full shadow-sm overflow-hidden">
        <div class="p-4 border-b border-outline-variant flex justify-between items-center bg-slate-50">
            <h3 class="font-bold text-primary text-sm tracking-tight">Nadadores Registrados</h3>
            <span class="material-symbols-outlined text-primary text-xl">pool</span>
        </div>

        <div class="flex-grow overflow-y-auto p-3 space-y-2 custom-scrollbar bg-slate-50/50">
            @if($alumnos->isEmpty())
                <p class="text-xs text-slate-400 text-center py-4">No hay alumnos matriculados aún.</p>
            @else
                @foreach($alumnos as $alumno)
                    <div class="w-full text-left p-3 rounded-lg bg-white border border-outline-variant/60 shadow-sm flex flex-col gap-1 hover:border-blue-500 hover:shadow-md transition-all cursor-pointer">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-800 uppercase tracking-tight">{{ $alumno->nombre }} {{ $alumno->apellido }}</span>
                            <span class="px-2 py-0.5 text-[10px] bg-blue-50 text-blue-600 rounded-full font-bold">
                                {{ $alumno->nivel->nombre ?? 'Sin Nivel' }}
                            </span>
                        </div>
                        <div class="text-[11px] text-slate-500 flex flex-col gap-0.5 pt-1 border-t border-slate-100 mt-1">
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[12px]">badge</span> Doc: {{ $alumno->identificacion }}</span>
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[12px]">person</span> Acudiente: {{ $alumno->acudiente_nombre }}</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="flex-grow bg-white rounded-xl border border-outline-variant flex flex-col h-full shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-white shrink-0">
            <div>
                <h3 class="font-bold text-lg text-primary">Formulario de Matrícula</h3>
                <p class="text-xs text-slate-500">Completa la información técnica y los datos obligatorios</p>
            </div>
            <div>
                <button type="submit" form="formMatricula" class="px-5 py-2.5 text-xs font-bold bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">assignment_turned_in</span> Finalizar Matrícula
                </button>
            </div>
        </div>

        <div class="flex-grow overflow-y-auto p-6 bg-[#F8FAFC] custom-scrollbar">
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-xs font-semibold">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="formMatricula" action="{{ route('alumnos.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div class="bg-white p-5 rounded-xl border border-outline-variant/60 shadow-sm space-y-4">
                    <h4 class="font-bold text-xs text-blue-600 uppercase tracking-wider border-b pb-2 flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">person</span> 1. Datos Personales del Alumno
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Nombres *</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-blue-500 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Apellidos *</label>
                            <input type="text" name="apellido" value="{{ old('apellido') }}" required class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-blue-500 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Número de Identificación *</label>
                            <input type="text" name="identificacion" value="{{ old('identificacion') }}" required class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-blue-500 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Edad *</label>
                            <input type="number" name="edad" value="{{ old('edad') }}" required class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-blue-500 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Fecha de Nacimiento *</label>
                            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-blue-500 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Observaciones Médicas</label>
                            <input type="text" name="observaciones_medicas" value="{{ old('observaciones_medicas') }}" class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-blue-500 bg-slate-50/50" placeholder="Alergias, asma, etc.">
                        </div>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-outline-variant/60 shadow-sm space-y-4">
                    <h4 class="font-bold text-xs text-blue-600 uppercase tracking-wider border-b pb-2 flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">supervisor_account</span> 2. Datos del Acudiente Responsable
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Nombre Completo del Acudiente *</label>
                            <input type="text" name="acudiente_nombre" value="{{ old('acudiente_nombre') }}" required class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-blue-500 bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Teléfono de Contacto Celular *</label>
                            <input type="text" name="acudiente_telefono" value="{{ old('acudiente_telefono') }}" required class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-blue-500 bg-slate-50/50">
                        </div>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-outline-variant/60 shadow-sm space-y-4">
                    <h4 class="font-bold text-xs text-blue-600 uppercase tracking-wider border-b pb-2 flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">military_tech</span> 3. Clasificación Deportiva
                    </h4>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Seleccionar Nivel Técnico Inicial *</label>
                        <select name="nivel_actual_id" id="nivel_actual_id" required class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-blue-500 bg-white">
                            <option value="">-- Seleccione un nivel --</option>
                            @foreach($niveles as $nivel)
                                <option value="{{ $nivel->id }}" {{ old('nivel_actual_id') == $nivel->id ? 'selected' : '' }}>
                                    {{ strtoupper($nivel->nombre) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection