<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaKids - Matrícula</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                    <p class="font-bold mb-1">Por favor corrige los siguientes errores:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-8 border border-gray-200">
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Formulario de Matrícula de Nadadores</h2>
                    <p class="text-sm text-gray-500">Completa la información técnica y los datos obligatorios del acudiente.</p>
                </div>

                <form action="{{ route('alumnos.store') }}" method="POST">
                    @csrf

                    <h3 class="text-md font-bold uppercase tracking-wider text-blue-600 mb-4">1. Datos Personales del Alumno</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombres *</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="apellido" class="block text-sm font-medium text-gray-700">Apellidos *</label>
                            <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('apellido') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="identificacion" class="block text-sm font-medium text-gray-700">Número de Identificación *</label>
                            <input type="text" name="identificacion" id="identificacion" value="{{ old('identificacion') }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('identificacion') border-red-500 @enderror">
                            @error('identificacion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento *</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('fecha_nacimiento') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="edad" class="block text-sm font-medium text-gray-700">Edad *</label>
                            <input type="number" name="edad" id="edad" value="{{ old('edad') }}" required min="1" max="99" class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('edad') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="observaciones_medicas" class="block text-sm font-medium text-gray-700">Observaciones Médicas</label>
                            <input type="text" name="observaciones_medicas" id="observaciones_medicas" value="{{ old('observaciones_medicas') }}" placeholder="Ej: Asma, ninguna" class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('observaciones_medicas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <h3 class="text-md font-bold uppercase tracking-wider text-blue-600 mb-4">2. Datos del Acudiente Responsable</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="acudiente_nombre" class="block text-sm font-medium text-gray-700">Nombre Completo del Acudiente *</label>
                            <input type="text" name="acudiente_nombre" id="acudiente_nombre" value="{{ old('acudiente_nombre') }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('acudiente_nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="acudiente_telefono" class="block text-sm font-medium text-gray-700">Teléfono de Contacto Celular *</label>
                            <input type="text" name="acudiente_telefono" id="acudiente_telefono" value="{{ old('acudiente_telefono') }}" placeholder="Ej: 3001234567" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('acudiente_telefono') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <h3 class="text-md font-bold uppercase tracking-wider text-blue-600 mb-4">3. Clasificación Deportiva</h3>
                    <div class="mb-8">
                        <label for="nivel_actual_id" class="block text-sm font-medium text-gray-700">Seleccionar Nivel Técnico Inicial *</label>
                        <select name="nivel_actual_id" id="nivel_actual_id" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Seleccione un Nivel Técnico Base --</option>
                            @foreach($niveles as $nivel)
                                <option value="{{ $nivel->id }}" {{ old('nivel_actual_id') == $nivel->id ? 'selected' : '' }}>{{ $nivel->nombre }}</option>
                            @endforeach
                        </select>
                        @error('nivel_actual_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end space-x-3 border-t border-gray-100 pt-6">
                        <a href="{{ route('alumnos.index') }}" class="bg-gray-100 text-gray-700 px-5 py-2.5 rounded-md hover:bg-gray-200 font-semibold transition">Cancelar</a>
                        <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-md hover:bg-blue-700 font-semibold shadow-sm transition">Finalizar Matrícula</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>