@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-6 py-4">
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Grupos y Horarios</h1>
            <p class="text-sm text-gray-500">Gestión de jornadas de AquaKids</p>
        </div>
        <a href="{{ route('grupos.create') }}" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-sm transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Nuevo Grupo
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Nombre del Grupo</th>
                    <th class="px-6 py-3">Horario</th>
                    <th class="px-6 py-3">Nivel Técnico</th>
                    <th class="px-6 py-3">Entrenador</th>
                    <th class="px-6 py-3">Cupo Máx</th>
                    <th class="px-6 py-3 text-center">Acciones</th> </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @forelse($grupos as $grupo)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">#{{ $grupo->id }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $grupo->nombre_grupo }}</td>
                        <td class="px-6 py-4">{{ $grupo->horario }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-sky-50 text-sky-700">
                                {{ strtoupper($grupo->nivel->nombre ?? $grupo->nivel->nombre_nivel ?? 'Sin Nivel') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $grupo->coach->nombre ?? 'Sin Coach asignado' }}</td>
                        <td class="px-6 py-4 font-medium text-gray-500">{{ $grupo->cupo_maximo }} alumnos</td>
                        
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este grupo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 transition-colors">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            No hay grupos registrados todavía.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection