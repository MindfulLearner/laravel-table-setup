<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tomtom-international/web-sdk-maps"></script>
    <style>
        #map {
            height: 400px;
            width: 100%; 
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Laravel Map Example</h1>
        </header>

        <main>
            @yield('content') <!-- Sezione dinamica -->
        </main>
    </div>
</body>
</html>
