@extends('layouts.app')

@section('content')
<div class="flex-grow bg-[#F8FAFC] rounded-xl border border-outline-variant p-6 h-full overflow-y-auto flex flex-col gap-6 custom-scrollbar">
    
    <div class="flex items-center gap-2 border-b border-outline-variant/60 pb-4">
        <a href="{{ route('niveles.index') }}" class="text-on-surface-variant hover:bg-surface-container-low p-1.5 rounded-lg transition-colors flex items-center justify-center">
            <span class="material-symbols-outlined text-lg">arrow_back</span>
        </a>
        <div class="flex flex-col gap-0.5">
            <h2 class="font-bold text-xl text-primary tracking-tight">Crear Nuevo Nivel Técnico</h2>
            <p class="text-[11px] text-on-surface-variant">Agrega una nueva categoría para la clasificación deportiva.</p>
        </div>
    </div>

    <div class="max-w-xl bg-white border border-outline-variant/60 rounded-xl p-6 shadow-sm mx-auto w-full">
        <form action="{{ route('niveles.store') }}" method="POST" class="flex flex-col gap-5">
            @csrf
            
            <div class="flex flex-col gap-1.5">
                <label for="nombre" class="text-xs font-bold text-on-surface-variant uppercase">Nombre del Nivel *</label>
                <input type="text" name="nombre" id="nombre" required maxlength="50" placeholder="Ej: Principiante, Experto, Mariposas" 
                       class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-primary bg-[#F8FAFC]">
                @error('nombre') <span class="text-error text-[11px] font-semibold">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col gap-1.5">
                <label for="descripcion" class="text-xs font-bold text-on-surface-variant uppercase">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4" placeholder="Detalla los objetivos principales de este nivel técnico..." 
                          class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-primary bg-[#F8FAFC] resize-none"></textarea>
                @error('descripcion') <span class="text-error text-[11px] font-semibold">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col gap-1.5">
                <label for="requisitos" class="text-xs font-bold text-on-surface-variant uppercase">Requisitos de Entrada</label>
                <input type="text" name="requisitos" id="requisitos" placeholder="Ej: Flotación básica, perder el miedo al agua profunda" 
                       class="w-full p-2.5 text-sm border border-outline-variant rounded-lg focus:outline-none focus:border-primary bg-[#F8FAFC]">
                @error('requisitos') <span class="text-error text-[11px] font-semibold">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-2 border-t border-outline-variant/40 mt-2">
                <a href="{{ route('niveles.index') }}" class="border border-outline-variant text-on-surface-variant hover:bg-surface-container-low font-bold py-2.5 px-4 rounded-lg text-xs transition-all">
                    Cancelar
                </a>
                <button type="submit" class="bg-primary hover:bg-primary/90 text-white font-bold py-2.5 px-4 rounded-lg text-xs transition-all shadow-sm flex items-center justify-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">save</span>
                    Guardar Nivel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection