@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-4 bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 w-full max-w-lg">
        
        <div class="flex items-center gap-2 mb-6 text-gray-500 hover:text-gray-700 transition-colors">
            <a href="{{ route('grupos.index') }}" class="flex items-center gap-1 text-sm font-medium">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Volver a grupos
            </a>
        </div>

        <h2 class="text-xl font-bold text-gray-900 mb-6 text-center">Nuevo Grupo</h2>

        <form action="{{ route('grupos.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Grupo</label>
                <input type="text" name="nombre_grupo" placeholder="Ej: Principiantes Mañana" required value="{{ old('nombre_grupo') }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white text-gray-700 shadow-sm">
                @error('nombre_grupo')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Horario / Jornada</label>
                <select name="horario" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white text-gray-700 shadow-sm">
                    <option value="">-- Selecciona una jornada y horario --</option>
                    <optgroup label="Jornada Mañana">
                        <option value="Lunes a Viernes: 6:00 AM - 8:00 AM" {{ old('horario') == 'Lunes a Viernes: 6:00 AM - 8:00 AM' ? 'selected' : '' }}>Lunes a Viernes: 6:00 AM - 8:00 AM</option>
                        <option value="Lunes a Viernes: 8:00 AM - 10:00 AM" {{ old('horario') == 'Lunes a Viernes: 8:00 AM - 10:00 AM' ? 'selected' : '' }}>Lunes a Viernes: 8:00 AM - 10:00 AM</option>
                    </optgroup>
                    <optgroup label="Jornada Tarde / Noche">
                        <option value="Lunes a Viernes: 2:00 PM - 4:00 PM" {{ old('horario') == 'Lunes a Viernes: 2:00 PM - 4:00 PM' ? 'selected' : '' }}>Lunes a Viernes: 2:00 PM - 4:00 PM</option>
                        <option value="Lunes a Viernes: 4:00 PM - 6:00 PM" {{ old('horario') == 'Lunes a Viernes: 4:00 PM - 6:00 PM' ? 'selected' : '' }}>Lunes a Viernes: 4:00 PM - 6:00 PM</option>
                    </optgroup>
                </select>
                @error('horario')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nivel Técnico</label>
                <select name="nivel_id" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white text-gray-700 shadow-sm">
                    <option value="">-- Selecciona un nivel técnico --</option>
                    @foreach($niveles as $nivel)
                        <option value="{{ $nivel->id }}" {{ old('nivel_id') == $nivel->id ? 'selected' : '' }}>
                            {{ $nivel->nombre ?? $nivel->nombre_nivel }}
                        </option>
                    @endforeach
                </select>
                @error('nivel_id')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entrenador</label>
                <select name="coach_id" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white text-gray-700 shadow-sm">
                    <option value="">-- Selecciona un entrenador --</option>
                    @foreach($entrenadores as $entrenador)
                        <option value="{{ $entrenador->id }}" {{ old('coach_id') == $entrenador->id ? 'selected' : '' }}>
                            {{ $entrenador->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('coach_id')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('grupos.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 font-medium text-sm transition-colors">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-medium text-sm shadow-sm transition-colors">Guardar Grupo</button>
            </div>
        </form>
    </div>
</div>
@endsection