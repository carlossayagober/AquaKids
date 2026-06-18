```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AquaKids - Bienvenido</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 flex items-center justify-center min-h-screen text-white font-sans selection:bg-blue-500">

    <div class="text-center max-w-lg p-6">
        <h1 class="text-5xl font-extrabold tracking-wider text-blue-500 mb-4">
            AQUAKIDS
        </h1>
        <p class="text-gray-400 text-lg mb-8">
            Sistema de Gestión Académica y Control de Aprendizaje de Natación.
        </p>
        
        @if (Route::has('login'))
            <div class="flex justify-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-lg shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-0.5">
                        Ir al Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-lg shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-0.5">
                        Iniciar Sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-slate-800 hover:bg-slate-700 text-gray-300 font-bold px-6 py-3 rounded-lg transition transform hover:-translate-y-0.5">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

</body>
</html>
