<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Biblioteca de Videojuegos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('Favicon/favicon.png') }}" type="image/png">
</head>
<body class="antialiased font-sans bg-gradient-to-br from-purple-900 to-purple-600 text-white">
    <div class="min-h-screen flex flex-col items-center justify-center text-center">
        <!-- Logo -->
        <div class="mb-8">
            <svg class="w-24 h-24 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.654 0 3-1.346 3-3s-1.346-3-3-3-3 1.346-3 3 1.346 3 3 3zM16.24 16.24A6.978 6.978 0 0112 18c-3.86 0-7-3.141-7-7a6.978 6.978 0 011.76-4.24M21 21l-4.35-4.35" />
            </svg>
        </div>

        <!-- Título -->
        <h1 class="text-4xl font-bold mb-4">Mi Biblioteca de Videojuegos</h1>
        <p class="text-lg mb-8">Gestiona tus videojuegos favoritos y mantén un registro organizado.</p>

        <!-- Botones -->
        <div class="flex gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-purple-600 hover:bg-purple-500 rounded-lg font-medium transition">
                        Ir al Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-purple-600 hover:bg-purple-500 rounded-lg font-medium transition">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-purple-700 hover:bg-slate-200 rounded-lg font-medium transition">
                        Regístrate
                    </a>
                @endauth
            @endif
        </div>

        <!-- Pie de página -->
        <footer class="mt-12 text-purple-200 text-sm">
            <p>&copy; {{ date('Y') }} Mi Biblioteca de Videojuegos. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>
