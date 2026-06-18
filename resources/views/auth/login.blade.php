@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-blue-950 to-blue-800 p-6">
    
    <div class="text-center mb-10 text-white">
        <div class="w-20 h-20 bg-white/10 rounded-3xl mx-auto mb-6 flex items-center justify-center backdrop-blur-sm border border-white/10 shadow-inner">
            <span class="text-4xl">≈</span>
        </div>
        <h1 class="text-4xl font-extrabold tracking-tight">AquaKids</h1>
        <p class="text-white/80 mt-2">Sistema de Gestión de Academia de Natación</p>
    </div>

    <div class="bg-white p-10 rounded-3xl shadow-2xl border border-gray-100 w-full max-w-lg">
        
        <div class="flex bg-gray-100 rounded-full p-1.5 mb-10 border border-gray-200" id="tab-container">
            <button id="tab-login" class="flex-1 py-3 px-6 text-sm font-bold bg-blue-600 text-white rounded-full shadow-md">Iniciar sesión</button>
            <button id="tab-register" class="flex-1 py-3 px-6 text-sm font-bold text-gray-600 hover:text-blue-600 rounded-full">Crear cuenta</button>
        </div>

        <form id="auth-form" action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                <input type="email" id="email" name="email" required placeholder="admin@aquakids.com"
                    class="w-full px-4 py-3.5 border border-gray-200 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-200 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Contraseña</label>
                <input type="password" id="password" name="password" required placeholder="••••••••"
                    class="w-full px-4 py-3.5 border border-gray-200 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-200 outline-none transition">
            </div>

            <div id="error-box" class="text-red-500 text-xs hidden"></div>
            @if ($errors->any())
                <div class="text-red-500 text-xs">@foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach</div>
            @endif

            <button type="submit" id="submit-btn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5">
                Ingresar
            </button>
        </form>
    </div>
</div>

<script>
    const form = document.getElementById('auth-form');
    const tabLogin = document.getElementById('tab-login');
    const tabRegister = document.getElementById('tab-register');
    const submitBtn = document.getElementById('submit-btn');
    const errorBox = document.getElementById('error-box');

    // Lógica de cambio de tabs
    tabRegister.addEventListener('click', () => {
        form.action = "{{ route('register') }}";
        tabRegister.className = "flex-1 py-3 px-6 text-sm font-bold bg-blue-600 text-white rounded-full shadow-md";
        tabLogin.className = "flex-1 py-3 px-6 text-sm font-bold text-gray-600 hover:text-blue-600 rounded-full";
        submitBtn.innerText = "Crear cuenta";
    });

    tabLogin.addEventListener('click', () => {
        form.action = "{{ route('login') }}";
        tabLogin.className = "flex-1 py-3 px-6 text-sm font-bold bg-blue-600 text-white rounded-full shadow-md";
        tabRegister.className = "flex-1 py-3 px-6 text-sm font-bold text-gray-600 hover:text-blue-600 rounded-full";
        submitBtn.innerText = "Ingresar";
    });

    // Validación JavaScript
    form.addEventListener('submit', (e) => {
        const email = document.getElementById('email').value;
        const pass = document.getElementById('password').value;
        errorBox.classList.add('hidden');
        
        if (!email.includes('@')) {
            errorBox.innerText = "El correo debe ser válido y contener '@'";
            errorBox.classList.remove('hidden');
            e.preventDefault();
        } else if (pass.length < 6) {
            errorBox.innerText = "La contraseña debe tener al menos 6 caracteres";
            errorBox.classList.remove('hidden');
            e.preventDefault();
        }
    });
</script>
@endsection