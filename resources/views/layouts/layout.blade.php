<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Videos App' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<header class="bg-blue-600 text-white p-8 text-center rounded-b-lg shadow-md">
    <h1 class="text-4xl md:text-5xl font-extrabold uppercase tracking-widest font-sans">
        VideosApp
    </h1>
</header>

<!-- Navbar -->
<nav class="bg-gray-800 shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo o títol petit, si cal -->
            <div class="flex-shrink-0 text-white font-bold text-lg">
                VideosApp
            </div>

            <!-- Botó menú mòbil -->
            <div class="md:hidden">
                <button id="btn-menu" aria-label="Toggle menu" class="text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Menú ordinador i mòbil -->
            <ul id="menu" class="hidden md:flex md:space-x-6 text-white font-semibold uppercase tracking-wide text-sm">
                <li><a href="{{ route('videos.manage.index') }}" class="btn-navbar">Gestió de Vídeos</a></li>
                <li><a href="{{ route('videos.index') }}" class="btn-navbar">Inici</a></li>
                <li><a href="{{ route('users.index') }}" class="btn-navbar">Usuaris</a></li>
                <li><a href="{{ route('users.manage.index') }}" class="btn-navbar">Gestió d'Usuaris</a></li>
                <li><a href="{{ route('series.index') }}" class="btn-navbar">Series</a></li>
                <li><a href="{{ route('series.manage.index') }}" class="btn-navbar">Gestió de Series</a></li>
            </ul>
        </div>
    </div>

    <!-- Menú desplegable mòbil -->
    <ul id="menu-mobile" class="md:hidden bg-gray-700 text-white font-semibold uppercase tracking-wide text-sm hidden flex-col space-y-2 px-4 py-3">
        <li><a href="{{ route('videos.manage.index') }}" class="btn-navbar-mobile">Gestió de Vídeos</a></li>
        <li><a href="{{ route('videos.index') }}" class="btn-navbar-mobile">Inici</a></li>
        <li><a href="{{ route('users.index') }}" class="btn-navbar-mobile">Usuaris</a></li>
        <li><a href="{{ route('users.manage.index') }}" class="btn-navbar-mobile">Gestió d'Usuaris</a></li>
        <li><a href="{{ route('series.index') }}" class="btn-navbar-mobile">Series</a></li>
        <li><a href="{{ route('series.manage.index') }}" class="btn-navbar-mobile">Gestió de Series</a></li>
    </ul>
</nav>

<main class="flex-grow max-w-7xl mx-auto p-6">
    {{ $slot }}
</main>

<footer class="bg-gray-900 text-gray-400 text-center py-4 border-t border-gray-700">
    &copy; {{ date('Y') }} Alexander Beltran Ferrers
</footer>

<script>
    // Toggle menú mòbil
    const btnMenu = document.getElementById('btn-menu');
    const menuMobile = document.getElementById('menu-mobile');
    btnMenu.addEventListener('click', () => {
        menuMobile.classList.toggle('hidden');
    });
</script>
</body>
</html>
