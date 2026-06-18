@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Entrenadores</h2>
            <p class="text-gray-500 text-sm">Gestión de personal de la academia</p>
        </div>
        <a href="{{ route('entrenadores.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold shadow-sm transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-lg">add</span>
            Nuevo Entrenador
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr class="text-gray-500 text-xs uppercase tracking-wider">
                    <th class="py-4 px-6">Nombre</th>
                    <th class="py-4 px-6">Especialidad</th>
                    <th class="py-4 px-6">Contacto</th>
                    <th class="py-4 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($entrenadores as $entrenador)
                <tr class="hover:bg-blue-50/30 transition-colors group">
                    <td class="py-4 px-6 font-medium text-gray-800">{{ $entrenador->nombre }} {{ $entrenador->apellido }}</td>
                    <td class="py-4 px-6 text-gray-600">{{ $entrenador->especialidad }}</td>
                    <td class="py-4 px-6 text-gray-600 text-sm">{{ $entrenador->telefono }}</td>
                    <td class="py-4 px-6">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('entrenadores.edit', $entrenador->id) }}" 
                               class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-100 rounded-lg transition-all" title="Editar">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <form action="{{ route('entrenadores.destroy', $entrenador->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar a este entrenador?')">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-100 rounded-lg transition-all" title="Eliminar">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection