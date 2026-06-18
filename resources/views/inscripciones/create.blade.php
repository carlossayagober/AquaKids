@extends('layouts.app')

@section('content')
<div class="w-full max-w-2xl mx-auto px-6 py-4">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('inscripciones.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Nueva Inscripción</h1>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <form action="{{ route('inscripciones.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="alumno_id" class="block text-sm font-semibold text-gray-700 mb-2">Seleccionar Nadador</label>
                <select name="alumno_id" id="alumno_id" required class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white text-gray-700 shadow-sm">
                    <option value="">-- Selecciona un nadador --</option>
                    @foreach($alumnos as $alumno)
                        <option value="{{ $alumno->id }}" {{ old('alumno_id') == $alumno->id ? 'selected' : '' }}>
                            {{ $alumno->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('alumno_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
<div>
    <label for="grupo_id" class="block text-sm font-semibold text-gray-700 mb-2">Asignar Grupo / Horario</label>
    <select name="grupo_id" id="grupo_id" required class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white text-gray-700 shadow-sm">
        <option value="">-- Selecciona un grupo --</option>
        @foreach($grupos as $grupo)
            <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                {{ $grupo->nombre_grupo }} | 
                Nivel: {{ $grupo->nivel->nombre ?? 'Sin nivel' }} | 
                Horario: {{ $grupo->horario }} | 
                Entrenador: {{ $grupo->entrenador->nombre ?? 'Sin asignar' }}
            </option>
        @endforeach
    </select>
</div>

            <div>
                <label for="fecha_inscripcion" class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Inscripción</label>
                <input type="date" name="fecha_inscripcion" id="fecha_inscripcion" required value="{{ old('fecha_inscripcion', date('Y-m-d')) }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white text-gray-700 shadow-sm">
                @error('fecha_inscripcion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="estado" class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                <select name="estado" id="estado" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white text-gray-700 shadow-sm">
                    <option value="Activa" {{ old('estado', 'Activa') == 'Activa' ? 'selected' : '' }}>Activa</option>
                    <option value="Inactiva" {{ old('estado') == 'Inactiva' ? 'selected' : '' }}>Inactiva</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('inscripciones.index') }}" class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                    Cancelar
                </a>
                <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow-sm transition-colors">
                    Guardar Inscripción
                </button>
            </div>
        </form>
    </div>
</div>
@endsection