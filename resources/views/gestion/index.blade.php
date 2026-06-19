@extends('layouts.app')

@section('content')
<main class="pt-8 pb-12 px-8 flex justify-center">
    <div class="w-full max-w-5xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Gestión Integrada: Asistencia y Pagos</h2>

        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-400 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Estudiante</th>
                        <th class="px-6 py-4 font-semibold">Asistencia</th>
                        <th class="px-6 py-4 font-semibold">Estado Asistencia</th>
                        <th class="px-6 py-4 font-semibold">Estado Pago</th>
                        <th class="px-6 py-4 font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($alumnos as $alumno)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="block font-medium text-gray-700">{{ $alumno->nombre }}</span>
                            <span class="text-xs text-gray-400">ID: #{{ $alumno->id }}</span>
                        </td>
                        <td class="px-6 py-4 text-xl">
                            <button onclick="abrirModal('Asistencia', {{ $alumno->id }}, 1)" class="text-green-600 font-bold hover:scale-110 transition">✓</button>
                            <button onclick="abrirModal('Asistencia', {{ $alumno->id }}, 1)" class="text-red-600 font-bold ml-3 hover:scale-110 transition">✗</button>
                        </td>
                        <td class="px-6 py-4">
                            @php $ultimaAsistencia = $alumno->asistencias()->latest()->first(); @endphp
                            <span class="font-bold text-sm uppercase {{ $ultimaAsistencia ? ($ultimaAsistencia->asistencia == 'Asistió' ? 'text-green-600' : 'text-red-600') : 'text-gray-400' }}">
                                {{ $ultimaAsistencia ? $ultimaAsistencia->asistencia : 'Sin registro' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($alumno->pagos->isNotEmpty())
                                <span class="text-black font-bold uppercase text-sm">PAGADO</span>
                            @else
                                <span class="text-red-500 font-bold uppercase text-sm">PENDIENTE</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button onclick="abrirModal('Pago', {{ $alumno->id }})" class="text-blue-600 font-bold text-sm hover:underline">Registrar Pago</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<div id="modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white p-6 rounded-lg w-full max-w-sm shadow-xl">
        <h3 id="modalTitle" class="text-lg font-bold mb-4 text-gray-800">Registrar</h3>
        <form id="modalForm" method="POST">
            @csrf
            <input type="hidden" name="alumno_id" id="alumno_id">
            <input type="hidden" name="grupo_id" id="grupo_id">
            
            <div id="formContent" class="mb-6"></div>
            
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-blue-900 text-white py-2 rounded font-bold hover:bg-blue-800">Guardar</button>
                <button type="button" onclick="cerrarModal()" class="flex-1 bg-gray-100 py-2 rounded font-bold text-gray-700 hover:bg-gray-200">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModal(tipo, id, grupoId = null) {
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modalTitle').innerText = "Registrar " + tipo + " (ID: " + id + ")";
    document.getElementById('alumno_id').value = id;
    
    let content = document.getElementById('formContent');
    if(tipo === 'Pago') {
        content.innerHTML = '<label class="block text-xs font-bold text-gray-500 mb-1">MONTO</label><input type="number" name="monto" class="w-full border border-gray-300 rounded p-2" required>';
        document.getElementById('modalForm').action = "{{ route('pagos.store') }}";
    } else {
        document.getElementById('grupo_id').value = grupoId;
        content.innerHTML = '<label class="block text-xs font-bold text-gray-500 mb-1">ASISTENCIA</label><select name="asistencia" class="w-full border border-gray-300 rounded p-2"><option value="Asistió">Asistió</option><option value="Faltó">Faltó</option></select>';
        document.getElementById('modalForm').action = "{{ route('asistencia.store') }}";
    }
}
function cerrarModal() { document.getElementById('modal').classList.add('hidden'); }
</script>
@endsection