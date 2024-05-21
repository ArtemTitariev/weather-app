<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    @vite('resources/css/app.css')
    @yield('resources')
</head>
<body class="bg-light font-sans">
    @yield('content')

    @vite('resources/js/app.js')
</body>
</html>
