<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>AquaKids Admin</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Hanken+Grotesk:wght@600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .zebra-table tr:nth-child(even), .zebra-row:nth-child(even) { background-color: #f9fbfc; }
        .scrollbar-hide::-webkit-scrollbar, .custom-scrollbar::-webkit-scrollbar { display: none; }
        .liquid-card { background: #FFFFFF; box-shadow: 0 4px 12px -2px rgba(0, 71, 171, 0.08); transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .liquid-card:hover { transform: translateY(-2px); box-shadow: 0 8px 16px -4px rgba(0, 71, 171, 0.12); }
    </style>
</head>
<body class="bg-[#F0F4F8] text-on-surface font-body-md min-h-screen flex overflow-hidden">

    <aside class="fixed left-0 top-0 h-full w-64 bg-surface flex flex-col py-6 border-r border-outline-variant shadow-md z-40">
        <div class="px-6 mb-10">
            <h1 class="font-bold text-2xl text-primary">AquaKids</h1>
            <p class="text-on-surface-variant text-xs font-semibold uppercase tracking-widest opacity-70">Management Portal</p>
        </div>
        
        <nav class="flex-grow space-y-1 px-3 overflow-y-auto scrollbar-hide">
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ Request::routeIs('dashboard') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}" href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined" style="{{ Request::routeIs('dashboard') ? 'font-variation-settings: \'FILL\' 1' : '' }}">dashboard</span>
                <span class="text-sm font-semibold">Dashboard</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ Request::routeIs('alumnos.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}" href="{{ route('alumnos.index') }}">
                <span class="material-symbols-outlined" style="{{ Request::routeIs('alumnos.*') ? 'font-variation-settings: \'FILL\' 1' : '' }}">pool</span>
                <span class="text-sm font-semibold">Nadadores</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ Request::routeIs('inscripciones.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}" href="{{ route('inscripciones.index') }}">
                <span class="material-symbols-outlined" style="{{ Request::routeIs('inscripciones.*') ? 'font-variation-settings: \'FILL\' 1' : '' }}">assignment_turned_in</span>
                <span class="text-sm font-semibold">Inscripciones</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ Request::routeIs('asistencias.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}" href="/asistencias">
                <span class="material-symbols-outlined" style="{{ Request::routeIs('asistencias.*') ? 'font-variation-settings: \'FILL\' 1' : '' }}">calendar_month</span>
                <span class="text-sm font-semibold">Asistencias</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ Request::routeIs('pagos.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}" href="/pagos">
                <span class="material-symbols-outlined" style="{{ Request::routeIs('pagos.*') ? 'font-variation-settings: \'FILL\' 1' : '' }}">payments</span>
                <span class="text-sm font-semibold">Pagos</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ Request::routeIs('entrenadores.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}" href="{{ route('entrenadores.index') }}">
                <span class="material-symbols-outlined" style="{{ Request::routeIs('entrenadores.*') ? 'font-variation-settings: \'FILL\' 1' : '' }}">sports</span>
                <span class="text-sm font-semibold">Entrenadores</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ Request::routeIs('niveles.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}" href="{{ route('niveles.index') }}">
                <span class="material-symbols-outlined" style="{{ Request::routeIs('niveles.*') ? 'font-variation-settings: \'FILL\' 1' : '' }}">layers</span>
                <span class="text-sm font-semibold">Niveles</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ Request::routeIs('grupos.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}" href="{{ route('grupos.index') }}">
                <span class="material-symbols-outlined" style="{{ Request::routeIs('grupos.*') ? 'font-variation-settings: \'FILL\' 1' : '' }}">group</span>
                <span class="text-sm font-semibold">Grupos</span>
            </a>
        </nav>

        <div class="mt-auto px-3 border-t border-outline-variant pt-6 space-y-1">
            @auth
            <div class="px-4 py-3 mb-2 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold shadow-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex flex-col overflow-hidden">
                    <span class="text-xs font-bold text-on-surface truncate">{{ auth()->user()->email }}</span>
                    <span class="text-[10px] text-on-surface-variant uppercase tracking-widest font-semibold">Administrador</span>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-error hover:bg-error-container/20 transition-all">
                    <span class="material-symbols-outlined text-error">logout</span>
                    <span class="text-sm font-semibold text-error">Cerrar Sesión</span>
                </button>
            </form>
            @endauth
        </div>
    </aside>

    <main class="ml-64 flex-grow flex flex-col h-screen overflow-hidden">
        <header class="flex justify-between items-center px-8 h-16 w-full bg-surface-container-lowest shadow-sm border-b border-outline-variant sticky top-0 z-30">
            <h2 class="text-xl font-bold text-primary">AquaKids Admin</h2>
            <div class="h-10 w-10 rounded-full bg-primary overflow-hidden border-2 border-outline-variant">
                <img alt="Admin" src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'A' }}&background=0D8ABC&color=fff"/>
            </div>
        </header>

        <div class="flex-grow flex p-8 overflow-hidden gap-6">
            @yield('content')
        </div>
    </main>

</body>
</html>