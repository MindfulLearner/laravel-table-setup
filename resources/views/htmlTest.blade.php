<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
  <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>
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
