<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaKids - Actualizar Alumno</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-8 border border-gray-200">
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Actualizar Expediente del Alumno</h2>
                    <p class="text-sm text-gray-500">Modifica los campos necesarios del nadador o actualiza su nivel técnico.</p>
                </div>

                <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h3 class="text-md font-bold uppercase tracking-wider text-indigo-600 mb-4">1. Datos Personales</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombres *</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $alumno->nombre) }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm">
                        </div>

                        <div>
                            <label for="apellido" class="block text-sm font-medium text-gray-700">Apellidos *</label>
                            <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $alumno->apellido) }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm">
                        </div>

                        <div>
                            <label for="tipo_documento" class="block text-sm font-medium text-gray-700">Tipo Documento *</label>
                            <select name="tipo_documento" id="tipo_documento" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm">
                                <option value="RC" {{ old('tipo_documento', $alumno->tipo_documento) == 'RC' ? 'selected' : '' }}>Registro Civil (RC)</option>
                                <option value="TI" {{ old('tipo_documento', $alumno->tipo_documento) == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad (TI)</option>
                                <option value="CC" {{ old('tipo_documento', $alumno->tipo_documento) == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía (CC)</option>
                                <option value="CE" {{ old('tipo_documento', $alumno->tipo_documento) == 'CE' ? 'selected' : '' }}>Cédula de Extranjería (CE)</option>
                            </select>
                        </div>

                        <div>
                            <label for="documento" class="block text-sm font-medium text-gray-700">Número de Identificación *</label>
                            <input type="text" name="documento" id="documento" value="{{ old('documento', $alumno->documento) }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm">
                        </div>

                        <div>
                            <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento *</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm">
                        </div>

                        <div>
                            <label for="tipo_sangre" class="block text-sm font-medium text-gray-700">Tipo de Sangre (Rh) *</label>
                            <input type="text" name="tipo_sangre" id="tipo_sangre" value="{{ old('tipo_sangre', $alumno->tipo_sangre) }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm">
                        </div>
                    </div>

                    <h3 class="text-md font-bold uppercase tracking-wider text-indigo-600 mb-4">2. Datos de Acudiente</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="acudiente_nombre" class="block text-sm font-medium text-gray-700">Nombre de Acudiente *</label>
                            <input type="text" name="acudiente_nombre" id="acudiente_nombre" value="{{ old('acudiente_nombre', $alumno->acudiente_nombre) }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm">
                        </div>

                        <div>
                            <label for="acudiente_telefono" class="block text-sm font-medium text-gray-700">Teléfono Celular *</label>
                            <input type="text" name="acudiente_telefono" id="acudiente_telefono" value="{{ old('acudiente_telefono', $alumno->acudiente_telefono) }}" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm">
                        </div>
                    </div>

                    <h3 class="text-md font-bold uppercase tracking-wider text-indigo-600 mb-4">3. Nivel de Nado</h3>
                    <div class="mb-8">
                        <label for="nivel_id" class="block text-sm font-medium text-gray-700">Actualizar Categoría / Nivel Técnico *</label>
                        <select name="nivel_id" id="nivel_id" required class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border shadow-sm">
                            @foreach($niveles as $nivel)
                                <option value="{{ $nivel->id }}" {{ old('nivel_id', $alumno->nivel_id) == $nivel->id ? 'selected' : '' }}>{{ $nivel->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3 border-t border-gray-100 pt-6">
                        <a href="{{ route('alumnos.index') }}" class="bg-gray-100 text-gray-700 px-5 py-2.5 rounded-md hover:bg-gray-200 font-semibold transition">Cancelar</a>
                        <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-md hover:bg-indigo-700 font-semibold shadow-sm transition">Actualizar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>