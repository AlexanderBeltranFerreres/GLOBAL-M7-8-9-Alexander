<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideosAppAlexander</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enllaça el teu CSS aquí -->
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    header {
        background-color: #007bff;
        color: white;
        padding: 1rem;
        text-align: center;
    }

    main {
        flex: 1;
        padding: 2rem;
    }

    footer {
        background-color: #f1f1f1;
        text-align: center;
        padding: 1rem;
        font-size: 0.9rem;
        color: #555;
    }

</style>
<body>
<header>
    <h1>VideosAppAlexander</h1>
</header>
<main>
    <!-- per a indicar on va lo de les vistes -->
    {{ $slot }}
</main>

<footer>
    <p>&copy; <span id="year"></span> Alexander Beltran Ferreres</p>
</footer>

<script>
    document.getElementById('year').textContent = new Date().getFullYear();
</script>
</body>
</html>
