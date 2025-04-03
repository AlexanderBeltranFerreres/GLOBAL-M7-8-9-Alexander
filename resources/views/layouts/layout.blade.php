<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Videos App' }}</title>
    <style>
        /* Header Styles */
        .app-header {
            background-color: #4E73DF; /* Blau vibrant */
            color: #fff;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .app-header-title {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #333;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        .navbar-nav li {
            display: inline-block;
            margin: 0 20px;
        }

        .navbar-nav a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        .navbar-nav a:hover {
            color: #f8f9fa;
            text-decoration: underline;
        }

        /* Main content area */
        main {
            padding: 40px 20px;
            background-color: #f4f6f9;
            min-height: 600px;
        }

        /* Footer Styles */
        .app-footer {
            background-color: #222;
            color: #aaa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #444;
            margin-top: 40px;
        }

        .app-footer-text {
            font-size: 14px;
            margin: 0;
            color: #bbb;
        }

        /* Button-like links in the navbar */
        .navbar-nav a {
            padding: 10px 20px;
            border-radius: 25px;
            background-color: #575757;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .navbar-nav a:hover {
            background-color: #4E73DF;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .app-header-title {
                font-size: 28px;
            }

            .navbar-nav li {
                display: block;
                margin: 10px 0;
            }

            .navbar-nav a {
                font-size: 16px;
                padding: 10px 15px;
            }
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body>
<header class="app-header">
    <h1 class="app-header-title">VideosApp</h1>
</header>

<!-- Navbar -->
<nav class="navbar">
    <ul class="navbar-nav">
        <li><a href="{{ route('videos.manage.index') }}">Gestió de Vídeos</a></li>
        <li><a href="{{ route('videos.index') }}">Inici</a></li>
        <li><a href="{{route('users.index')}}">Usuaris</a></li>
        <li><a href="{{route('users.manage.index')}}">Gestió d'Usuaris</a></li>
    </ul>
</nav>

<main>
    {{ $slot }}
</main>

<footer class="app-footer">
    <p class="app-footer-text">&copy; {{ date('Y') }} Alexander Beltran Ferrers</p>
</footer>
</body>
</html>
