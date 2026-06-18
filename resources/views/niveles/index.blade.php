@extends('layouts.app')

@section('content')
<div class="flex-grow bg-[#F8FAFC] rounded-xl border border-outline-variant p-6 h-full overflow-y-auto flex flex-col gap-6 custom-scrollbar">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-outline-variant/60 pb-4">
        <div class="flex flex-col gap-1">
            <h2 class="font-bold text-2xl text-primary tracking-tight">Niveles Técnicos</h2>
            <p class="text-xs text-on-surface-variant">Configura las categorías de aprendizaje para los nadadores de AquaKids.</p>
        </div>
        <a href="{{ route('niveles.create') }}" class="bg-primary hover:bg-primary/90 text-white font-bold py-2 px-4 rounded-lg text-xs transition-all shadow-sm flex items-center justify-center gap-1.5 self-start sm:self-auto">
            <span class="material-symbols-outlined text-sm">add_circle</span>
            Nuevo Nivel
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-primary/10 border border-primary/20 text-primary rounded-lg text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @if($niveles->isEmpty())
            <div class="col-span-full bg-white border border-outline-variant/60 rounded-xl p-8 text-center flex flex-col items-center justify-center gap-2">
                <span class="material-symbols-outlined text-3xl text-outline">layers_clear</span>
                <p class="text-xs text-outline font-medium">No hay niveles registrados. ¡Crea el primero para comenzar!</p>
            </div>
        @else
            @foreach($niveles as $nivel)
                <div class="bg-white border border-outline-variant/60 rounded-xl p-5 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-primary/40 transition-all gap-4">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-start justify-between gap-2">
                            <span class="text-base font-black text-primary uppercase tracking-wide">{{ $nivel->nombre }}</span>
                            <span class="w-7 h-7 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-base">layers</span>
                            </span>
                        </div>
                        
                        @if($nivel->descripcion)
                            <p class="text-xs text-on-surface-variant line-clamp-3 leading-relaxed">{{ $nivel->descripcion }}</p>
                        @else
                            <p class="text-xs text-outline italic">Sin descripción registrada.</p>
                        @endif

                        @if($nivel->requisitos)
                            <div class="mt-2 p-2 bg-surface-container-low rounded-lg border border-outline-variant/30">
                                <span class="text-[10px] font-bold text-secondary uppercase tracking-wider block mb-0.5">Requisitos</span>
                                <p class="text-[11px] text-on-surface font-medium">{{ $nivel->requisitos }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-end gap-1 pt-3 border-t border-outline-variant/40">
                        <a href="{{ route('niveles.edit', $nivel->id) }}" class="text-secondary hover:bg-secondary/10 p-2 rounded-lg transition-colors flex items-center justify-center" title="Editar">
                            <span class="material-symbols-outlined text-base">edit</span>
                        </a>
                        <form action="{{ route('niveles.destroy', $nivel->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este nivel? Esto puede afectar a los alumnos inscritos.')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-error hover:bg-error/10 p-2 rounded-lg transition-colors flex items-center justify-center" title="Eliminar">
                                <span class="material-symbols-outlined text-base">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection