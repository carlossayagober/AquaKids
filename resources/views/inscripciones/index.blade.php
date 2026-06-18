@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-6 py-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Inscripciones</h1>
        <a href="{{ route('inscripciones.create') }}" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
            + Nueva inscripción
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Nadador</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Grupo</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Nivel</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Entrenador</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Estado</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($inscripciones as $inscripcion)
                <tr><td class="px-6 py-4 text-gray-600">
    {{ $inscripcion->grupo->entrenador->nombre ?? 'Sin Entrenador' }}
</td>
                    <td class="px-6 py-4 text-gray-600">{{ $inscripcion->grupo->nombre_grupo ?? 'Sin grupo' }}</td>
                    
                    <td class="px-6 py-4 text-gray-600">
                       {{ strtoupper($inscripcion->grupo->nivel->nombre ?? $inscripcion->grupo->nivel->nombre_nivel ?? 'SIN NIVEL') }}
                    </td>
                    
                    <td class="px-6 py-4 text-gray-600">{{ $inscripcion->grupo->coach->nombre ?? 'Sin Entrenador' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs {{ $inscripcion->estado == 'Activa' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $inscripcion->estado }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('inscripciones.destroy', $inscripcion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta inscripción?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection