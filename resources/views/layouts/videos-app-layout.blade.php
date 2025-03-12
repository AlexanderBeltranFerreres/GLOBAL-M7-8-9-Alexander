<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Videos App' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-light">

<header class="app-header bg-dark text-white">
    <div class="container">
        <h1 class="app-header-title">VideosAppAlexander</h1>
    </div>
</header>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="{{ route('videos.manage.index') }}" class="nav-link">Gestió de Vídeos</a></li>
            <li class="nav-item"><a href="{{ route('videos.index') }}" class="nav-link">Inici</a></li>
        </ul>
    </div>
</nav>

<main class="container my-4">
    {{ $slot }}
</main>

<footer class="app-footer bg-light text-center py-3">
    <p class="app-footer-text text-muted">&copy; {{ date('Y') }} Alexander Beltran Ferreres<</p>
</footer>

<!-- Estils CSS Addicionals -->
<style>
    /* Header Styling */
    .app-header {
        padding: 20px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .app-header-title {
        font-size: 24px;
        font-weight: bold;
        margin: 0;
        letter-spacing: 1px;
    }

    /* Navbar Styling */
    .navbar {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .navbar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .navbar-nav .nav-item {
        margin: 0 15px;
    }

    .navbar-nav .nav-link {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
    }

    .navbar-nav .nav-link:hover {
        text-decoration: underline;
    }

    /* Footer Styling */
    .app-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #ddd;
    }

    .app-footer-text {
        font-size: 14px;
        margin: 0;
        color: #666;
    }

    /* Estil per a la taula i altres components */
    .container {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Taula estils per si necessites utilitzar en els teus components */
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #0069d9;
        color: white;
        font-weight: bold;
    }

    .table td {
        background-color: #fafafa;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .btn {
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .navbar-nav .nav-item {
            margin: 0 10px;
        }
    }
</style>

</body>
</html>
