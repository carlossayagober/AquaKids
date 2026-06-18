```html
@extends('layouts.app')

@section('content')
<div class="flex-grow bg-[#F8FAFC] rounded-xl border border-outline-variant p-6 h-full overflow-y-auto flex flex-col gap-6 custom-scrollbar">
    
    <div class="flex flex-col gap-1">
        <h2 class="font-bold text-2xl text-primary tracking-tight">¡Bienvenido de nuevo, Admin!</h2>
        <p class="text-xs text-on-surface-variant">Aquí tienes el estado actual y las métricas clave de la academia AquaKids.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white border border-outline-variant/60 rounded-xl p-5 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Nadadores Activos</span>
                <span class="text-3xl font-black text-primary">{{ $totalAlumnos }}</span>
            </div>
            <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl">pool</span>
            </div>
        </div>

        <div class="bg-white border border-outline-variant/60 rounded-xl p-5 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Niveles Técnicos</span>
                <span class="text-3xl font-black text-secondary">{{ $totalNiveles }}</span>
            </div>
            <div class="w-12 h-12 rounded-lg bg-secondary/10 flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-2xl">layers</span>
            </div>
        </div>

        <div class="bg-white border border-outline-variant/60 rounded-xl p-5 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Alertas de Salud</span>
                <span class="text-3xl font-black text-error">{{ $alumnosConObservaciones->count() }}</span>
            </div>
            <div class="w-12 h-12 rounded-lg bg-error/10 flex items-center justify-center text-error">
                <span class="material-symbols-outlined text-2xl">health_and_safety</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 flex-grow">
        
        <div class="bg-white border border-outline-variant/60 rounded-xl p-5 shadow-sm flex flex-col gap-4">
            <div class="flex items-center gap-2 border-b border-outline-variant/60 pb-3">
                <span class="material-symbols-outlined text-primary text-xl">bar_chart</span>
                <h3 class="font-bold text-sm text-on-surface uppercase tracking-tight">Ocupación por Niveles</h3>
            </div>
            <div class="space-y-4 overflow-y-auto flex-grow pr-1">
                @if($nivelesConConteo->isEmpty())
                    <p class="text-xs text-outline text-center py-6">No hay niveles registrados en el sistema.</p>
                @else
                    @foreach($nivelesConConteo as $nivel)
                        @php
                            $porcentaje = $totalAlumnos > 0 ? ($nivel->alumnos_count / $totalAlumnos) * 100 : 0;
                        @endphp
                        <div class="flex flex-col gap-1">
                            <div class="flex justify-between text-xs font-bold">
                                <span class="text-on-surface-variant uppercase">{{ $nivel->nombre }}</span>
                                <span class="text-primary">{{ $nivel->alumnos_count }} {{ $nivel->alumnos_count == 1 ? 'alumno' : 'alumnos' }}</span>
                            </div>
                            <div class="w-full bg-surface-container-low h-2.5 rounded-full overflow-hidden border border-outline-variant/30">
                                <div class="bg-primary h-full transition-all duration-500" style="width: {{ $porcentaje }}%"></div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="bg-white border border-outline-variant/60 rounded-xl p-5 shadow-sm flex flex-col gap-4">
            <div class="flex items-center gap-2 border-b border-outline-variant/60 pb-3">
                <span class="material-symbols-outlined text-error text-xl">medical_services</span>
                <h3 class="font-bold text-sm text-on-surface uppercase tracking-tight">Observaciones Médicas de Cuidado</h3>
            </div>
            <div class="space-y-3 overflow-y-auto flex-grow pr-1 custom-scrollbar">
                @if($alumnosConObservaciones->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-outline gap-2">
                        <span class="material-symbols-outlined text-3xl text-secondary">verified_user</span>
                        <p class="text-xs text-center">Todos los nadadores se encuentran sin novedades médicas registradas.</p>
                    </div>
                @else
                    @foreach($alumnosConObservaciones as $alumno)
                        <div class="p-3 bg-error-container/10 border border-error/20 rounded-lg flex flex-col gap-1">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-error uppercase">{{ $alumno->nombre }} {{ $alumno->apellido }}</span>
                                <span class="text-[10px] bg-white border border-error/20 px-2 py-0.5 rounded text-error font-medium">Nivel: {{ $alumno->nivel->nombre ?? 'N/A' }}</span>
                            </div>
                            <p class="text-xs text-on-surface-variant italic">"{{ $alumno->observaciones_medicas }}"</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>
@endsection