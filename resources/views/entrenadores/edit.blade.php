@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 flex justify-center">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200 w-full max-w-2xl">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Entrenador</h2>
        
        <form action="{{ route('entrenadores.update', $entrenador->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ $entrenador->nombre }}" required class="w-full border border-gray-300 rounded-lg p-2.5">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                    <input type="text" name="apellido" value="{{ $entrenador->apellido }}" required class="w-full border border-gray-300 rounded-lg p-2.5">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Especialidad</label>
                <input type="text" name="especialidad" value="{{ $entrenador->especialidad }}" required class="w-full border border-gray-300 rounded-lg p-2.5">
            </div>

            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="text" name="telefono" value="{{ $entrenador->telefono }}" required class="w-full border border-gray-300 rounded-lg p-2.5">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors">
                Guardar Cambios
            </button>
        </form>
    </div>
</div>
@endsection